<?php
include("../faterzin/verificar_loginadmin.php");
$activePage = 'clientes';
include '../includes/sidebar.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="../css/equipe.css">
    <title><?php echo $titulo_site ?> - Admin</title>
    <link rel="shortcut icon" href="<?php echo $imagem_site ?>" type="image/x-icon" />
</head>

<body>
<main>
        <div class="recent-orders">
            <h2>Registrar novo usuário:</h2>
        </div>

        <ul>
            <form action="" method="post">
                <li><label for="telefone">Telefone do Usuário:</label>
                    <input type="text" id="telefone" name="telefone" required>
                </li>

                <li><label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" required>
                </li>

                <li><label for="cep">CEP:</label>
                    <input type="text" id="cep" name="cep" required>
                </li>

                <li><label for="endereco">Endereço:</label>
                    <input type="text" id="endereco" name="endereco" required>
                </li>

                <li><label for="cadastro">Cadastro:</label>
                    <select id="cadastro" name="cadastro" required>
                        <option value="1">Sim</option>
                        <option value="2">Pendente</option>
                    </select>
                </li>

                <div><button type="submit">Adicionar</button></div>
            </form>
        </ul>

        <?php if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nome = $_POST['nome'];
            $telefone = $_POST['telefone'];
            $cep = $_POST['cep'];
            $endereco = $_POST['endereco'];
            $cadastro = $_POST['cadastro'];
        
            $stmt = $conn->prepare("INSERT INTO clientes (nome, telefone, cep, address, cadastrado) VALUES (?, ?, ?, ?, 1)");
            $stmt->bind_param("sssss", $nome, $telefone, $cep, $endereco);

            if ($stmt->execute()) {
                echo "<p style='color: green;'>Usuário cadastrado com sucesso!</p>";
            } else {
                echo "<p style='color: red;'>Erro ao cadastrar usuário: " . $conn->error . "</p>";
            }

            $stmt->close();
        }
        ?>

    </main>
</body>

<?php include '../includes/adminbar.php'; ?>
<script src="../js/configuracoes.js"></script>
<script src="../js/darkmode.js"></script>

</html>