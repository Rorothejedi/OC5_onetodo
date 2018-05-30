<?php
namespace App\model;

/**
 * Class MessageManager
 * Gére toutes les requêtes relative à la messagerie, au messages et aux conversation.
 */
class MessageManager
{
	
	/**
	 * Permet d'afficher le nombre de message non-lus de l'utilisateur en cours.
	 * @param  User   $user Objet User désignant l'utilisateur en cours nécessaire pour récupérer l'identifiant de celui-ci.
	 * @return int    	    Nombre de ligne indiquant les conversations non vus.
	 */
	public function getNotSeenMessage(User $user)
	{
		$data = App::getDb()->prepare('
			SELECT seen
			FROM seen
			WHERE id_user = :id AND seen = 0',
			['id' => $user->id()],
		true, false, true);

		return $data;
	}

	/**
	 * Permet de récupérer toutes les discussions concernant un utilisateur.
	 * @param  User   $user Objet User désignant l'utilisateur en cours nécessaire pour récupérer l'identifiant de celui-ci.
	 * @return array        Renvoi un tableau (fetchAll) contenant toutes les données de la requête. 
	 */
	public function getConversations(User $user)
	{
		$data = App::getDb()->prepare('
			SELECT m.id_conversation, m.id_user, m.content, DATE_FORMAT(m.date_reception, "%d/%m/%Y à %Hh%i") AS date_reception,
			u.username, u.email, s.seen
			FROM message m
			INNER JOIN conversation c ON c.id = m.id_conversation
			INNER JOIN user u ON u.id = m.id_user
			INNER JOIN seen s ON s.id_user = :id AND s.id_conversation = m.id_conversation
			WHERE m.date_reception IN (
				SELECT MAX( m.date_reception ) 
				FROM message m 
				GROUP BY m.id_conversation )
			GROUP BY m.id_conversation
			ORDER BY s.seen ASC, m.date_reception DESC
			LIMIT 20',
			['id' => $user->id()],
		true, false, false);

		return $data;
	}

	/**
	 * Liste les utilisateurs présent dans les conversation de l'utilisateur actuel hormis celui-ci.
	 * @param  int    $id_conversation Identifiant de la conversation où les utilisateurs sont présents.
	 * @param  int    $id_user         Identifiant de l'utilisateur actuel.
	 * @return array                   Renvoi un tableau (fetchAll) contenant toutes les données de la requête. 
	 */
	public function getUsersConversations($id_conversation, $id_user)
	{
		$data = App::getDb()->prepare('
			SELECT u.username
			FROM seen s
			INNER JOIN user u ON u.id = s.id_user
			WHERE s.id_conversation = :id_conversation AND s.id_user != :id_user',
			['id_conversation' => $id_conversation,
			'id_user'          => $id_user ],
		true, false, false);

		return $data;
	}

	/**
	 * Affichage des 6 contacts les plus actifs (ceux qui ont le plus d'occurences dans les mêmes conversations que l'utilisateur actuel)
	 * @param  User   $user Objet User désignant l'utilisateur en cours nécessaire pour récupérer l'identifiant de celui-ci.
	 * @return array        Renvoi un tableau (fetchAll) contenant toutes les données de la requête. 
	 */
	public function getMainContact(User $user)
	{
		$data = App::getDb()->prepare('
			SELECT s.id_user, u.username, u.email
			FROM seen s
			INNER JOIN user u ON u.id = s.id_user
			WHERE s.id_user != :id AND s.id_conversation IN (
				SELECT s.id_conversation 
				FROM seen s
				WHERE s.id_user = :id )
			GROUP BY s.id_user
			ORDER BY COUNT( s.id_user ) DESC
			LIMIT 6',
			['id' => $user->id()],
		true, false, false);

		return $data;
	}


	/**
	 * Affiche rowCount pour savoir si un utilisateur est dans une conversation (vérification pour savoir s'il peut y accéder)
	 * @param  User   $user            Objet User désignant l'utilisateur en cours nécessaire pour récupérer l'identifiant de celui-ci.
	 * @param  int    $id_conversation Identifiant de la conversation où l'utilisateur en cours est présent.
	 * @return int                     Nombre de ligne indiquant la présence d'utilisateur en cours.
	 */
	public function getAccessUserConversation(User $user, $id_conversation)
	{
		$data = App::getDb()->prepare('
			SELECT *
			FROM seen
			WHERE id_user = :id_user AND id_conversation = :id_conversation',
			['id_user'        => $user->id(),
			'id_conversation' => $id_conversation],
		true, false, true);

		return $data;
	}


	/**
	 * Permet de considérer qu'un utilisateur à vu une conversation avec un nouveau message.
	 * @param  User   $user            Objet User désignant l'utilisateur en cours nécessaire pour récupérer l'identifiant de celui-ci.
	 * @param  int $id_conversation Identifiant de la conversation à indiquer comme vu.
	 */
	public function seenConversation(User $user, $id_conversation)
	{
		$data = App::getDb()->prepare('
			UPDATE seen
			SET seen = 1
			WHERE id_user = :id_user AND id_conversation = :id_conversation',
			['id_user'        => $user->id(), 
			'id_conversation' => $id_conversation]
		);
	}

	/**
	 * Affiche une seule conversation en fonction de son id.
	 * @param  int 	 $id_conversation Identifiant de la conversation à afficher.
	 * @return array                  Renvoi un tableau (fetchAll) contenant toutes les données de la requête.
	 */
	public function getConversation($id_conversation)
	{
		$data = App::getDb()->prepare('
			SELECT m.id_conversation, m.id_user, m.content, DATE_FORMAT(m.date_reception, "%d/%m/%Y - %Hh%i") AS date_reception,
			u.username, u.email
			FROM message m
			INNER JOIN user u ON u.id = m.id_user
			WHERE m.id_conversation = :id
			ORDER BY m.date_reception',
			['id' => $id_conversation],
		true, false, false);

		return $data;
	}

	/**
	 * Affichage des 6 contacts les plus actifs pour qu'il puisse être ajouté à la conversation. Sont exclus des résultats, l'utilisateur en cours et les membres de la conversation en cours.
	 * @param  User   $user            Objet User désignant l'utilisateur en cours nécessaire pour récupérer l'identifiant de celui-ci.
	 * @param  int    $id_conversation Identifiant de la conversation à afficher.
	 * @return array                   Renvoi un tableau (fetchAll) contenant toutes les données de la requête.
	 */
	public function getMainContactAdd(User $user, $id_conversation)
	{
		$data = App::getDb()->prepare('
			SELECT s.id_user, u.username, u.email
			FROM seen s
			INNER JOIN user u ON u.id = s.id_user
			WHERE s.id_user NOT IN (
				SELECT id_user
				FROM seen s
				INNER JOIN user u ON u.id = s.id_user
				WHERE s.id_conversation = :id_conversation AND s.id_user != :id_user ) 
			AND s.id_conversation IN (
				SELECT s.id_conversation 
				FROM seen s
				WHERE s.id_user = :id_user )
			AND s.id_user != :id_user
			GROUP BY s.id_user
			ORDER BY COUNT( s.id_user ) DESC
			LIMIT 6',
			['id_user'        => $user->id(),
			'id_conversation' => $id_conversation],
		true, false, false);

		return $data;
	}

	/**
	 * Permet d'ajouter une nouvelle conversation à la base de données.
	 * @param  User   $user            Objet User désignant l'utilisateur en cours nécessaire pour récupérer l'identifiant de celui-ci.
	 * @return array                   Renvoi un tableau (fetch) contenant l'id de la dernière conversation ajouté à la base de données.
	 */
	public function addNewConversation(User $user)
	{
		$data = App::getDb()->prepare('
			BEGIN;
			INSERT INTO conversation (id) 
				VALUES (0);
			INSERT INTO seen (id_conversation, id_user)
				VALUES (LAST_INSERT_ID(), :id);
			COMMIT;',
			['id' => $user->id()],
		false, false, false);

		$dataBis = App::getDb()->query('
			SELECT MAX(id) AS id
			FROM conversation',
		true, true);

		return $dataBis;
	}

	/**
	 * Permet d'ajouter un utilisateur à une conversation.
	 * @param int $id_conversation Identifiant de la conversation à afficher.
	 * @param int $id_user         Identifiant de l'utilisateur à ajouter à la base de données.
	 */
	public function addUserConversation($id_conversation, $id_user)
	{
		$data = App::getDb()->prepare('
			INSERT INTO seen
				( id_conversation, id_user )
			VALUES 
				( :id_conversation, :id_user )',
			['id_conversation' => $id_conversation,
			'id_user'          => $id_user]
		);
	}

	/**
	 * Permet d'ajouter un nouveau message dans une conversation
	 * @param int    $id_conversation Identifiant de la conversation dans laquelle poster le message.
	 * @param int    $id_user         Identifiant de l'auteur du message.
	 * @param string $content         Contenu du message.
	 */
	public function addMessage($id_conversation, $id_user, $content)
	{
		$data = App::getDb()->prepare('
			BEGIN;
			INSERT INTO message (id_conversation, id_user, content, date_reception)
				VALUES (:id_conversation, :id_user, :content, NOW());
			UPDATE seen SET seen = 0 WHERE id_user != :id_user AND id_conversation = :id_conversation;
			COMMIT;',
			['id_conversation' => $id_conversation,
			'id_user'          => $id_user,
			'content'          => $content]
		);
	}

	/**
	 * Enleve l'utilisateur en cours de la conversation sélectionné.
	 * @param  int    $id_conversation Identifiant de la conversation auquelle l'accès à l'utilisateur doit être supprimé.
	 * @param  User   $user            Objet User désignant l'utilisateur en cours nécessaire pour récupérer l'identifiant de celui-ci.
	 */
	public function deleteUserConversation($id_conversation, User $user)
	{
		$data = App::getDb()->prepare('
			DELETE FROM seen
			WHERE id_conversation = :id_conversation AND id_user = :id_user',
			['id_conversation' => $id_conversation,
			'id_user' => $user->id()]
		);
	}

}