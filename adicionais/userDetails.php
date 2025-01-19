<?php
include("../faterzin/verificar_login.php");
$theme = 'light'; // Tema padrão
if (isset($_COOKIE['theme'])) {
    $theme = $_COOKIE['theme'];
}

$userId = $_GET['userId'];

$query = "SELECT * FROM funcionarios WHERE id = $userId";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    $nome = $user['nome'];
    $telefone = $user['telefone'];
    $funcao = $user['funcao'];
    $comissao = $user['pagamento'];
    $cep = $user['cep'];
    $endereco = $user['address'];
    $usuario = $user['user'];
    $email = $user['email'];
} else {
    echo "Usuário não encontrado.";
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

    <div class="container">
        <aside>
            <div class="toggle">
                <div class="logo">
                    <img src="../images/bolinha.png">
                    <h2>Use<span class="danger">Únnica</span></h2>
                </div>
                <div class="close" id="close-btn">
                    <span class="material-icons-sharp">
                        close
                    </span>
                </div>
            </div>

            <div class="sidebar">
                <a href="../dashboard.php">
                    <span class="material-icons-sharp">
                        dashboard
                    </span>
                    <h3>Dashboard</h3>
                </a>
                <a href="../equipe.php" class="active">
                    <span class="material-icons-sharp">
                        person_outline
                    </span>
                    <h3>Equipe</h3>
                </a>
                <a href="../vendas.php">
                    <span class="material-icons-sharp">
                        receipt_long
                    </span>
                    <h3>Vendas</h3>
                </a>
                <a href="../analytics.php">
                    <span class="material-icons-sharp">
                        insights
                    </span>
                    <h3>Analytics</h3>
                </a>
                <a href="../tickets.php">
                    <span class="material-icons-sharp">
                        mail_outline
                    </span>
                    <h3>Tickets</h3>
                    <span class="message-count">27</span>
                </a>
                <a href="../produtos.php">
                    <span class="material-icons-sharp">
                        shopping_cart
                    </span>
                    <h3>Produtos</h3>
                </a>
                <!--<a href="#">
                    <span class="material-icons-sharp">
                        report_gmailerrorred
                    </span>
                    <h3>Reports</h3>
                </a>-->
                <a href="../clientes.php">
                    <span class="material-icons-sharp">
                        add
                    </span>
                    <h3>Clientes</h3>
                </a>
                <a href="../configuracoes.php">
                    <span class="material-icons-sharp">
                        settings
                    </span>
                    <h3>Settings</h3>
                </a>
                <a href="../faterzin/logout.php">
                    <span class="material-icons-sharp">
                        logout
                    </span>
                    <h3>Logout</h3>
                </a>
            </div>
        </aside>
        <main>
            <div class="recent-orders">
                <h2><?php echo $nome ?></h2>
            </div>
            <div>
                <p>Usuário: <?php echo $usuario ?></p>
                <p>Email: <?php echo $email ?></p>
                <p>Telefone: <?php echo $telefone ?></p>
                <p>Funcao: <?php echo $funcao ?></p>
                <p>Comissão: <?php echo $comissao ?></p>
                <p>CEP: <?php echo $cep ?></p>
                <p>Endereço: <?php echo $endereco ?></p>

                <button id="editar-dados">Editar Dados</button>
                <style>
                    #editar-dados {
                        background-color: rgb(8, 93, 221);
                        /* Cor de fundo */
                        color: white;
                        /* Cor do texto */
                        border: none;
                        /* Remove bordas */
                        border-radius: 8px;
                        /* Bordas arredondadas */
                        padding: 7px 15px;
                        /* Espaçamento interno */
                        font-size: 13px;
                        /* Tamanho da fonte */
                        font-weight: bold;
                        /* Texto em negrito */
                        cursor: pointer;
                        /* Indicador de botão clicável */
                        transition: all 0.3s ease;
                        /* Suaviza a transição ao passar o mouse */
                        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
                        /* Sombra */
                    }

                    #editar-dados:hover {
                        background-color: #45a049;
                        /* Cor de fundo ao passar o mouse */
                        transform: scale(1.05);
                        /* Aumenta levemente o botão */
                        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.3);
                        /* Aumenta a sombra */
                    }

                    #editar-dados:active {
                        transform: scale(0.98);
                        /* Efeito de clique */
                        box-shadow: 0 3px 4px rgba(0, 0, 0, 0.2);
                        /* Reduz a sombra */
                    }
                </style>
            </div>
        </main>
        <div class="right-section">
            <div class="nav">
                <button id="menu-btn">
                    <span class="material-icons-sharp">
                        menu
                    </span>
                </button>
                <div class="dark-mode">
                    <span class="material-icons-sharp active">
                        light_mode
                    </span>
                    <span class="material-icons-sharp">
                        dark_mode
                    </span>
                </div>

                <div class="profile">
                    <div class="info">
                        <p>Hey, <b><?php echo $_SESSION['usuario'] ?></b></p>
                        <small class="text-muted">Admin</small>
                    </div>
                    <div class="profile-photo">
                        <img src="../images/profile-1.jpg">
                    </div>
                </div>
            </div>
        </div>
</body>
<script src="../js/darkmode.js"></script>

</html>