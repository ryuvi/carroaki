<?php
// LoginController.php
class LoginController {

    public function showLoginForm() {
        include('views/loginView.php'); // Exibe o formulário de login
    }

    public function login() {
        include('config/db.php');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = md5($_POST['password']); // Aplica MD5 antes de comparar

            // Prepara a consulta
            $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE username = :username AND password = :password");
            $stmt->execute(array(':username' => $username, ':password' => $password));
            $user = $stmt->fetch();

            // Se o usuário for encontrado, redireciona para a página inicial
            if ($user) {
                $_SESSION['user'] = $user['username'];
                // Redirecionamento para a página inicial
                header('Location: /');
                exit(); // Não esqueça de chamar exit() após o redirecionamento
            } else {
                $error = 'Usuário ou senha inválidos.';
                include('views/loginView.php'); // Exibe a view novamente com o erro
            }
        } else {
            // Se não for POST, exibe o formulário de login
            $this->showLoginForm();
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: index.php");
        exit();
    }
}
?>