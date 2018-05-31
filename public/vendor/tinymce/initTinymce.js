tinymce.init({
	selector: '#tinymce',
	language: 'fr_FR',
	menubar: false,
	branding: false,
	elementpath: false,
	autoresize_min_height: 400,
	plugins: ["autoresize", "link", "lists", "hr"],
	toolbar: "undo redo |  bold italic underline strikethrough | fontsizeselect | alignleft aligncenter alignright alignjustify | outdent indent | bullist hr blockquote | link | removeformat"
});