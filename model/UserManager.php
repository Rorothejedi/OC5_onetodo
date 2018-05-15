<?php
namespace App\model;

/**
 * Class UserManager
 * Permet de gérer les requêtes concernant les utilisateurs (ajout, récupération, suppression, ect).
 */
class UserManager
{
	public function getUser(User $user)
	{
		$data = App::getDb()->prepare('
			SELECT * FROM user WHERE id = :id OR username = :username OR email = :email',
			['id'       => $user->id(),
			':username' => $user->username(),
			':email'    => $user->email()],
		true, true, false);

		return new \App\model\User($data);
	}

	public function existUser($username, $email)
	{
		$data = App::getDb()->prepare('
			SELECT * FROM user WHERE username = :username OR email = :email',
			[':username' => $username,
			':email'     => $email],
		true, false, true);

		return $data;
	}

	/**
	 * Permet l'ajout d'un utilisateur dans la base de données
	 * @param User $user Prends l'objet User en paramètre
	 */
	public function addUser(User $user)
	{
		$data = App::getDb()->prepare('
			INSERT INTO user (username, email, password, token) 
			VALUES (:username, :email, :password, :token)', 
			[':username' => $user->username(),
			'email'      => $user->email(),
			'password'   => $user->password(),
			'token'      => $user->token()],
		false);
	}


	public function validateUser(User $user)
	{
		$data = App::getDb()->prepare('
			UPDATE user SET confirm_register = 1 WHERE username = :username', 
			[':username' => $user->username()],
		false);
	}

	// public function deleteUser($userId)
 //    {
 //        $db = $this->db_connect();

 //        try 
 //        {
 //            $db->beginTransaction();

 //            $req = $db->query('SELECT COUNT(*) FROM comment WHERE user_id = "' . $userId . '"');

 //            if ($req->fetchColumn() > 0)
 //            {
 //                $req = $db->prepare('DELETE user, comment FROM user, comment WHERE user.id = ?'); 
 //            }
 //            else
 //            {
 //                $req = $db->prepare('DELETE FROM user WHERE id = ?'); 
 //            }

 //            $req->execute(array($userId));
 //            $db->commit();

 //            return true;
 //        } 
 //        catch (Exception $e) 
 //        {
 //            $db->rollback();
 //        } 
 //    }

	// public function getUser($pseudo)
	// {
	// 	$db = $this->db_connect();

	// 	$req = $db->query('
	// 		SELECT id, pseudo, email, pass, access 
	// 		FROM user 
	// 		WHERE pseudo = "' . $pseudo . '"');
		
	// 	$data = $req->fetch();
		
	// 	return new User($data);
	// }

	// public function getUsers()
	// {
	// 	$db = $this->db_connect();

 //    	$users = $db->query('
	// 		SELECT id, pseudo, email, access 
	// 		FROM user 
	// 		ORDER BY access, pseudo');

 //    	return $users;
	// }

	// public function editUser(User $user)
	// {
	// 	$db = $this->db_connect();

	// 	$req = $db->prepare('
	// 		UPDATE user 
	// 		SET pseudo = :pseudo, email = :email, pass = :pass 
	// 		WHERE id = :id
	// 	');

	// 	$req->execute(array(
	// 		'id'     => $user->id(),
	// 		'pseudo' => $user->pseudo(),
	// 		'email'  => $user->email(),
	// 		'pass'   => $user->pass()
	// 	));
	// }
}