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
            <h2><?php echo$nome, ' (', $clientId, ')' ?></h2>
        </div>
        <div>
            <p>Telefone: <?php echo $telefone ?></p>
            <p>Número de Compras: <?php echo $compras ?></p>
            <p>Cadastro: <?php echo $cadastro ?></p>
            <p>CEP: <?php echo $cep ?></p>
            <p>Endereço: <?php echo $endereco ?></p>

            <button class="vermais" data-user-id="<?php echo $clientId ?>" id="editar-dados">Editar
                Dados</button>

            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    function setupVerMaisButtons() {
                        const verMaisButtons = document.querySelectorAll('.vermais');
                        verMaisButtons.forEach(button => {
                            button.addEventListener('click', (e) => {
                                const clientId = e.target.getAttribute('data-user-id');
                                if (clientId) {
                                    window.location.href = `../adicionais/clientEdit.php?clientId=${clientId}`;
                                } else {
                                    console.error('ID do cliente não encontrado!');
                                }
                            });
                        });
                    }

                    setupVerMaisButtons();
                });
            </script>

            <style>
                #editar-dados {
                    background-color: rgb(8, 93, 221);
                    color: white;
                    border: none;
                    border-radius: 8px;
                    padding: 7px 15px;
                    font-size: 13px;
                    font-weight: bold;
                    cursor: pointer;
                    transition: all 0.3s ease;
                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
                }

                #editar-dados:hover {
                    background-color: #45a049;
                    transform: scale(1.05);
                    box-shadow: 0 6px 8px rgba(0, 0, 0, 0.3);
                }

                #editar-dados:active {
                    transform: scale(0.98);
                    box-shadow: 0 3px 4px rgba(0, 0, 0, 0.2);
                }
            </style>
        </div>
    </main>


</body>
<?php include '../includes/adminbar.php'; ?>
<script src="../js/darkmode.js"></script>

</html>