<?php
// echo '</pre>';
$nome = $_POST['nomeUsuario'];
$sobrenome = $_POST['sobrenomeUsuario'];
$email = $_POST['email'];
$senha = $_POST['password'];
$senhaHash = sha1($senha); //Senha criptografada com sha1(nativo)
$newsletter = isset($_POST['newsletter']) ? 1 : 0; //If ternário

// --- testes no console: ----
// echo '</pre>';
// echo $nome .'<br>';
// echo $sobrenome .'<br>';
// echo $email .'<br>';
// echo $senha .'<br>';
// echo $senhaHash .'<br>';
// echo $newsletter .'<br>';

// echo '</pre>';

// MariaDB
$server =  "localhost";
$db = "formulario_php";
$user = "root";
$pass = "";

//Conexão com o BD
$conn = mysqli_connect($server, $user, $pass, $db);

if(!$conn) {
    die("Falha de conexão: " . mysqli_connect_error());
} else {
    echo 'Conectado!';
}

//Inserção no banco
$sql = "INSERT INTO tb_usuario
(nome, sobrenome, email, senha, newsletter)
VALUES ('{$nome}','{$sobrenome}','{$email}','{$senhaHash}', $newsletter)";

//Roda query e testa. Se der certo, redireciona
if (mysqli_query($conn, $sql)) {
    echo "Registro inserido com sucesso!<br>";    
    mysqli_close($conn); //Fecha conexão com o BD
    header('Location: sucesso.html'); //redireciona 
}else{
    echo "<br>Erro: " . $sql . "<br>" . mysqli_error($conn);
}


?>