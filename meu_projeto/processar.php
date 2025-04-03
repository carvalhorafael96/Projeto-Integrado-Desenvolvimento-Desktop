<?php
// Conectar ao banco de dados
$servername = "localhost";
$username = "root"; // Usuário padrão do XAMPP
$password = ""; // Senha padrão vazia no XAMPP
$database = "cadastro_empresas"; // Nome do banco de dados que você criou

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Capturar os dados do formulário
    $nome = $_POST['nome'];
    $cnpj = $_POST['cnpj'];
    $servico = $_POST['servico'];
    $projeto = $_POST['projeto'];
    $horas = $_POST['horas'];

    // Inserir a empresa apenas se ela ainda não existir
    $stmt = $conn->prepare("INSERT IGNORE INTO empresas (cnpj, nome) VALUES (:cnpj, :nome)");
    $stmt->execute([':cnpj' => $cnpj, ':nome' => $nome]);

    // Inserir o serviço na tabela servicos
    $stmt = $conn->prepare("INSERT INTO servicos (cnpj, servico, projeto, horas) VALUES (:cnpj, :servico, :projeto, :horas)");
    $stmt->execute([
        ':cnpj' => $cnpj,
        ':servico' => $servico,
        ':projeto' => $projeto,
        ':horas' => $horas
    ]);

    // Exibir a mensagem de sucesso com o botão para voltar ao cadastro
    echo "
        <html>
        <head>
            <meta charset='UTF-8'>
            <title>Sucesso</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    text-align: center;
                    margin: 50px;
                    background-color: #f4f4f4;
                }
                .container {
                    background: #fff;
                    padding: 20px;
                    max-width: 400px;
                    margin: auto;
                    border-radius: 8px;
                    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                }
                h2 {
                    color: #28a745;
                }
                a {
                    display: inline-block;
                    margin-top: 20px;
                    padding: 10px 20px;
                    background-color: #007bff;
                    color: white;
                    text-decoration: none;
                    border-radius: 5px;
                }
                a:hover {
                    background-color: #0056b3;
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <h2>Registro realizado com sucesso!</h2>
                <a href='index.html'>Realizar novo cadastro</a>
            </div>
        </body>
        </html>
    ";

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

// Fechar a conexão
$conn = null;
?>
