<?php

define('APP_RUNNING', true);
require('src/config.php');

// Verificação da conexão
if ($conexao->connect_error) {
    die("Conexão falhou: " . $conexao->connect_error);
}

//$nome = isset($_GET['nome']) ? urldecode($_GET['nome']) : '';
$nome_avaliacao = isset($_GET['nome_avaliacao']) ? urldecode($_GET['nome_avaliacao']) : '';
$sql = "SELECT * FROM avaliacao" . ($nome_avaliacao ? " WHERE nome_avaliacao LIKE '%$nome_avaliacao%'" : "") . " ORDER BY data_avaliacao DESC";
$result = $conexao->query($sql);

// Verifica se a consulta foi bem-sucedida
if (!$result) {
    die("Erro na consulta: " . $conexao->error);
}

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/tabela.css">
    <title>CARTEL - Progressos</title>
</head>

<body>

    <div class="left-section">

        <a href="index.html">
            <i class='bx bx-home-alt-2'></i>
        </a>

        <a href="forms/forms.html" class="">
            <i class='bx bx-file'></i>
        </a>

        <a href="forms/ai.html">
            <i class='bx bx-bowl-rice'></i>
        </a>

        <a href="dados.html" class="selected">
            <i class='bx bx-data'></i>
        </a>

    </div>

    <main>

        <div id="progressos">

            <input type="text" id="searchInputProgress" placeholder="Pesquisar progressos..."
                onkeyup="searchProgress();">

            <table class="table" border="1" id="progressTable">

                <thead>
                    <tr>
                        <th scope="col">Aluno</th>
                        <th scope="col">Data</th>
                        <th scope="col">Ver mais</th>
                        <th scope="col">...</th>
                    </tr>
                </thead>
                <tbody id="progressTable">
                    <?php

                    while ($user_data = mysqli_fetch_assoc($result)) {
                        // Exibe os dados do cliente na tabela

                        // Cria uma mensagem com os dados do progresso
                        $mensagem = "Protocolo projeto assimetria: " . $user_data['nome_avaliacao'] . "\n"
                            . "Data: " . date("d-m-Y", strtotime($user_data['data_avaliacao'])) . "\n"
                            . "Peso: " . $user_data['peso_avaliacao'] . " kg\n"
                            . "Peitoral: " . $user_data['peito_avaliacao'] . " cm\n"
                            . "Braço Esquerda: " . $user_data['braco_esq_avaliacao'] . " cm\n"
                            . "Braço Direita: " . $user_data['braco_dir_avaliacao'] . " cm\n"
                            . "Cintura: " . $user_data['cintura_avaliacao'] . " cm\n"
                            . "Abdômen: " . $user_data['abdomen_avaliacao'] . " cm\n"
                            . "Quadril: " . $user_data['quadril_avaliacao'] . " cm\n"
                            . "Coxa Esquerda: " . $user_data['coxa_esq_avaliacao'] . " cm\n"
                            . "Coxa Direita: " . $user_data['coxa_dir_avaliacao'] . " cm\n"
                            . "Panturrilha Esquerda: " . $user_data['panturrilha_esq_avaliacao'] . " cm\n"
                            . "Panturrilha Direita: " . $user_data['panturrilha_dir_avaliacao'] . " cm\n"
                            . "Objetivo: " . $user_data['objetivo_avaliacao'] . "\n\n";

                        // Codifica a mensagem para a URL
                        $mensagem_url = urlencode($mensagem);

                        echo "<tr>";
                        echo "<td>" . $user_data['nome_avaliacao'] . "</td>";
                        echo "<td>" . date("d-m-Y", strtotime($user_data['data_avaliacao'])) . "</td>";
                        echo "<td> <a href='vermais.php?nome_avaliacao=" . urlencode($user_data['nome_avaliacao']) . "'>Ver Mais</a> </td>";
                        echo "<td class='acoes'>
                                    <a class='btn-delete' href='acoes/deleteeditprogressos.php?pk_cod_avaliacao={$user_data['pk_cod_avaliacao']}'><i class='bx bx-trash'></i></a>
                                    <a class='btn-edit' href='acoes/editprogressos.php?pk_cod_avaliacao={$user_data['pk_cod_avaliacao']}'><i class='bx bx-edit-alt'></i></a>
                                    <a class='btn-share' href='https://api.whatsapp.com/send?text=$mensagem_url' target='_blank'><i class='bx bx-share'></i></a>
                                </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>

        </div>

    </main>

    <script src="js/script.js">
    </script>
</body>

</html>