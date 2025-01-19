<?php
include '../faterzin/verificar_login.php';
$activePage = 'clientes';
include '../includes/sidebar.php';

$clientId = $_GET['clientId'];

$query = "SELECT * FROM clientes WHERE id = $clientId";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $statusMap = [
        0 => 'Não',
        1 => 'Sim',
        2 => 'Pendente',
        3 => 'Removido'
    ];

    $user = mysqli_fetch_assoc($result);
    $nome = $user['nome'];
    $telefone = $user['telefone'];
    $cep = $user['cep'];
    $endereco = $user['address'];
    $cadastro = $statusMap[$user['cadastrado']] ?? 'Valor inválido';
    $compras = contarCompras($conn, $clientId);
    ;
} else {
    echo "Usuário não encontrado.";
}


function contarCompras($conn, $clientId)
{
    $clienteId = mysqli_real_escape_string($conn, $clientId);

    $sql = "SELECT COUNT(clienteid) AS total_compras FROM vendas WHERE clienteid = $clientId";
    $resultado = mysqli_query($conn, $sql);
    if (!$resultado) {
        die("Erro na consulta: " . mysqli_error($conn));
    }
    $row = mysqli_fetch_assoc($resultado);
    return $row['total_compras'];
}
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
            <p>Editar o usuário:</p>
            <h2><?php echo $nome, ' (', $clientId, ')' ?></h2>
        </div>

        <ul>
            <form action="" method="post">
                <input type="hidden" name="id" value="<?php echo $clientId; ?>">

                <li><label for="telefone">Telefone do Usuário:</label>
                    <input type="text" id="telefone" name="telefone" value="<?php echo $telefone ?>" required>
                </li>

                <li><label for="nome">Novo Nome:</label>
                    <input type="text" id="nome" name="nome" value="<?php echo $nome ?>" required>
                </li>

                <li><label for="cep">Novo CEP:</label>
                    <input type="text" id="cep" name="cep" value="<?php echo $cep ?>" required>
                </li>

                <li><label for="endereco">Novo Endereço:</label>
                    <input type="text" id="endereco" name="endereco" value="<?php echo $endereco ?>" required>
                </li>

                <li><label for="cadastro">Cadastro:</label>
                    <select id="cadastro" name="cadastro" required>
                        <option value="0" <?php echo $cadastro == 'Não' ? 'selected' : ''; ?>>Não</option>
                        <option value="1" <?php echo $cadastro == 'Sim' ? 'selected' : ''; ?>>Sim</option>
                        <option value="2" <?php echo $cadastro == 'Pendente' ? 'selected' : ''; ?>>Pendente</option>
                        <option value="3" <?php echo $cadastro == 'Removido' ? 'selected' : ''; ?>>Removido</option>
                    </select>
                </li>

                <div><button type="submit">Atualizar</button></div>
            </form>
        </ul>

        <?php if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nome = $_POST['nome'];
            $telefone = $_POST['telefone'];
            $cep = $_POST['cep'];
            $endereco = $_POST['endereco'];
            $cadastro = $_POST['cadastro']; // O valor será 0, 1, 2 ou 3 diretamente
        
            $stmt = $conn->prepare("UPDATE clientes SET nome = ?, telefone = ?, cep = ?, address = ?, cadastrado = ? WHERE id = ?");
            $stmt->bind_param("ssssii", $nome, $telefone, $cep, $endereco, $cadastro, $clientId);

            if ($stmt->execute()) {
                echo "<p style='color: green;'>Usuário atualizado com sucesso!</p>";
            } else {
                echo "<p style='color: red;'>Erro ao atualizar usuário: " . $conn->error . "</p>";
            }

            $stmt->close();
        }
        ?>

    </main>
</body>
<?php include '../includes/adminbar.php'; ?>
<script src="../js/darkmode.js"></script>

</html>