<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body,
        html {
            height: 100%;
            width: 100%;
        }

        a {
            text-decoration: none;
            color: #FF6659;
            text-align: center;
        }

        i {
            font-size: 24px;
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            width: 100%;
        }

        main {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        #backhome {
            text-decoration: underline;
            color: #B71C1C;
            font-weight: bolder;
        }

        /*main header {
            display: flex;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            margin: 20px;
            gap: 15px;
            margin-bottom: 30px;
            width: 100%;
        }

        .home {
            text-align: center;
        }

        .home img {
            width: 650px;
        }*/

        main .form-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            padding-top: 30px;
            align-items: center;
        }

        /*main .form-container form {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .form-container form div {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }


        main .form-container form label {
            color: #D32F2F;
            font-weight: 500;
        }

        .form-container form input {
            border: none;
            outline: none;
            padding: 0 20px;
            background-color: #dfdfdf80;
            height: 35px;
            width: 450px;
            margin-bottom: 20px;
        }

        .form-container form input[type="submit"] {
            background-color: #D32F2F;
            color: white;
            border-radius: 9999px;
            cursor: pointer;
        }

        #agenda input{
            width: 100%;
        }*/

        #cadastrar_cliente,
        #agenda,
        #matriculas,
        #avaliacoes,
        #progressos,
        #montarTreino {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        #matriculas #searchInputClient,
        #progressos #searchInputProgress {
            margin-bottom: 50px;
            width: 270px;
            padding: 10px 50px 10px 20px;
            border: 1px solid #D32F2F;
            border-radius: 5px;
            outline: none;
        }

        .form-container table tr td a {
            color: #FF6659;
            text-decoration: none;
        }

        .form-container table {
            width: 100%;
            border-collapse: collapse;
            margin: auto;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #ddd;
        }

        .form-container table thead {
            background-color: #D32F2F;
            color: #ffffff;
        }

        .form-container table th,
        .form-container table td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
            font-weight: 500;
        }

        .form-container table .acoes {
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            gap: 15px;
        }

        .form-container table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
            /* Cor de fundo para linhas pares */
        }

        .form-container table tbody tr:nth-child(odd) {
            background-color: #ffffff;
            /* Cor de fundo para linhas ímpares */
        }

        @media screen and (max-width: 1660px) {

            #progressos table {
                width: 70%;
                font-size: 10px;
            }
        }

        @media screen and (max-width: 1336px) {

            #progressos table .acoes a i {
                font-size: 20px;
            }
        }

        /*@media screen and (max-width: 1270px){
            #progressos{
                width: fit-content;
            }
        }*/

        @media screen and (max-width: 1226px) {

            /*.container .left-section,
            .container main {
                padding: 20px 20px 0 20px;
                border: none;
            }*/

            /*#iconeGym{
                display: block;
            }*/

            .container .left-section .logo .studiobox,
            #menu-close {
                display: none;
            }

            /*main{
                margin-left: 60px;
                width: calc(100%-60px);
            }*/

            /* chatgpt*/


            /*.container .left-section .sidebar a,
            .container .left-section .pic img {
                display: none;
            }*/

            #progressos table th,
            #progressos table td {
                padding: 10px;
            }

        }

        @media screen and (max-width: 992px) {

            #menu-close {
                display: block;
            }

            #iconeGym {
                display: none;
            }

            #gymMenu {
                display: block;
            }

            .container {
                grid-template-columns: 1fr 1fr;
            }

            /*.container .left-section {
                position: fixed;
                height: 60vh;
                background-color: #D32F2F;
                box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease;
                top: -60vh;
            }*/

            .container .left-section .item a,
            .container .left-section .item i {
                color: #fff;
            }

            main {
                margin-left: 0;
            }

            .container .left-section .logo {
                flex-direction: column;
                gap: 20px;
            }

            .container .left-section .logo .menu-btn,
            main header .menu-btn {
                display: flex;
            }

        }

        @media screen and (max-width: 768px) {

            .container {
                flex-direction: column;
            }

            .container .left-section {
                position: fixed;
                height: 60vh;
                width: 100%;
                top: -60vh;
                left: 0;
                transition: all 0.3s ease;
            }

            main {
                margin-left: 0;
                width: 100%;
            }

            .container.main .form-container input {
                width: 80%;
            }

            /*.container main .form-container form input {
                width: 300px;
            }

            .form-container table { 
                font-size: 12px; 
            } 
        
            .form-container table th, 
            .form-container table td {
                padding: 8px; 
            } */

        }

        @media screen and (max-width: 600px) {

            .form-container table th,
            .form-container table td {
                font-size: 10px;
                padding: 6px;
            }

            .home img {
                width: 350px;
            }
        }

        @media screen and (max-width: 488px) {

            .form-container table {
                font-size: 11px;
                width: 100%;
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

            .form-container table th,
            td {
                padding: 5px;
            }

            .form-container form input {
                width: 345px;
            }

        }
    </style>

    <title>CARTEL | StudioBox</title>
</head>

<body>

    <div class="container">

        <main>

            <a class="backhome" id="backhome" href="vermais.php">VOLTAR</a>

            <div class="form-container">

                <div id="progressos">

                    <?php

                    define('APP_RUNNING', true);
                    require_once('../src/config.php');

                    // Verifica se o formulário de avaliação foi enviado
                    if (isset($_POST['submit_avaliacao'])) {


                        require_once('../src/config.php');


                        // Captura os dados do formulário
                        $nome_avaliacao = $_POST['nome_avaliacao'];
                        $peso_avaliacao = $_POST['peso_avaliacao'];
                        $peito_avaliacao = $_POST['peito_avaliacao'];
                        $braco_esq_avaliacao = $_POST['braco_esq_avaliacao'];
                        $braco_dir_avaliacao = $_POST['braco_dir_avaliacao'];
                        $cintura_avaliacao = $_POST['cintura_avaliacao'];
                        $abdomen_avaliacao = $_POST['abdomen_avaliacao'];
                        $quadril_avaliacao = $_POST['quadril_avaliacao'];
                        $coxa_esq_avaliacao = $_POST['coxa_esq_avaliacao'];
                        $coxa_dir_avaliacao = $_POST['coxa_dir_avaliacao'];
                        $panturrilha_esq_avaliacao = $_POST['panturrilha_esq_avaliacao'];
                        $panturrilha_dir_avaliacao = $_POST['panturrilha_dir_avaliacao'];
                        $objetivo_avaliacao = $_POST['objetivo_avaliacao'];
                        $data_avaliacao = $_POST['data_avaliacao'];


                        // Insere os dados na tabela de avaliações
                        $result = mysqli_query($conexao, "INSERT INTO avaliacao(nome_avaliacao ,peso_avaliacao, peito_avaliacao, braco_esq_avaliacao, braco_dir_avaliacao, cintura_avaliacao, abdomen_avaliacao, quadril_avaliacao, coxa_esq_avaliacao, coxa_dir_avaliacao, panturrilha_esq_avaliacao, panturrilha_dir_avaliacao, objetivo_avaliacao, data_avaliacao) 
                            VALUES ('$nome_avaliacao' ,'$peso_avaliacao', '$peito_avaliacao', '$braco_esq_avaliacao', '$braco_dir_avaliacao', '$cintura_avaliacao', '$abdomen_avaliacao', '$quadril_avaliacao', '$coxa_esq_avaliacao', '$coxa_dir_avaliacao', '$panturrilha_esq_avaliacao', '$panturrilha_dir_avaliacao', '$objetivo_avaliacao', '$data_avaliacao')");
                    }

                    // Consulta para obter as avaliações
                    $sql = "SELECT * FROM avaliacao ORDER BY data_avaliacao DESC";
                    $result = $conexao->query($sql);

                    ?>

                    <?php
                    $nome_avaliacao = isset($_GET['nome_avaliacao']) ? urldecode($_GET['nome_avaliacao']) : '';

                    $sql = "SELECT nome_avaliacao, 
                            MIN(data_avaliacao) AS data_primeira_avaliacao,
                            AVG(IFNULL(peso_avaliacao, 0)) AS media_peso, 
                            MIN(IFNULL(peso_avaliacao, 0)) AS peso_inicial,
                            AVG(IFNULL(peito_avaliacao, 0)) AS media_peitoral, 
                            MIN(IFNULL(peito_avaliacao, 0)) AS peitoral_inicial,
                            AVG(IFNULL(braco_esq_avaliacao, 0)) AS media_braco_esq, 
                            MIN(IFNULL(braco_esq_avaliacao, 0)) AS braco_esq_inicial,
                            AVG(IFNULL(braco_dir_avaliacao, 0)) AS media_braco_dir, 
                            MIN(IFNULL(braco_dir_avaliacao, 0)) AS braco_dir_inicial,
                            AVG(IFNULL(cintura_avaliacao, 0)) AS media_cintura, 
                            MIN(IFNULL(cintura_avaliacao, 0)) AS cintura_inicial,
                            AVG(IFNULL(abdomen_avaliacao, 0)) AS media_abdomen, 
                            MIN(IFNULL(abdomen_avaliacao, 0)) AS abdomen_inicial,
                            AVG(IFNULL(quadril_avaliacao, 0)) AS media_quadril, 
                            MIN(IFNULL(quadril_avaliacao, 0)) AS quadril_inicial,
                            AVG(IFNULL(coxa_esq_avaliacao, 0)) AS media_coxa_esq, 
                            MIN(IFNULL(coxa_esq_avaliacao, 0)) AS coxa_esq_inicial,
                            AVG(IFNULL(coxa_dir_avaliacao, 0)) AS media_coxa_dir, 
                            MIN(IFNULL(coxa_dir_avaliacao, 0)) AS coxa_dir_inicial,
                            AVG(IFNULL(panturrilha_esq_avaliacao, 0)) AS media_panturrilha_esq, 
                            MIN(IFNULL(panturrilha_esq_avaliacao, 0)) AS panturrilha_esq_inicial,
                            AVG(IFNULL(panturrilha_dir_avaliacao, 0)) AS media_panturrilha_dir, 
                            MIN(IFNULL(panturrilha_dir_avaliacao, 0)) AS panturrilha_dir_inicial,
                            MAX(objetivo_avaliacao) AS objetivo_avaliacao
                        FROM avaliacao";

                    if ($nome_avaliacao) {
                        $sql .= " WHERE nome_avaliacao LIKE '%$nome_avaliacao%'";
                    }
                    $sql .= " GROUP BY nome_avaliacao ORDER BY nome_avaliacao";

                    $result = $conexao->query($sql);

                    function calcularEvolucao($media, $inicial)
                    {
                        return $inicial != 0 ? (($media - $inicial) / $inicial) * 100 : 0;
                    }

                    ?>

                    <table class="table" border="1" id="progressTable">
                        <input type="text" id="searchInputProgress" placeholder="Pesquisar progressos..." onkeyup="searchProgress();" value="<?php echo htmlspecialchars($nome_avaliacao); ?>">
                        <thead>
                            <tr>
                                <th scope="col">Aluno</th>
                                <th scope="col">Peso</th>
                                <th scope="col">Peitoral</th>
                                <th scope="col">Braço Esq</th>
                                <th scope="col">Braço Dir</th>
                                <th scope="col">Cintura</th>
                                <th scope="col">Abdômen</th>
                                <th scope="col">Quadril</th>
                                <th scope="col">Coxa Esq</th>
                                <th scope="col">Coxa Dir</th>
                                <th scope="col">Panturrilha Esq</th>
                                <th scope="col">Panturrilha Dir</th>
                                <th scope="col">Objetivo</th>
                                <th scope="col">...</th>
                            </tr>
                        </thead>
                        <tbody id="progressTable">
                            <?php
                            while ($user_data = mysqli_fetch_assoc($result)) {

                                // Cria uma mensagem com os dados do progresso
                                $mensagem = "Protocolo projeto assimetria com percentual: " . $user_data['nome_avaliacao'] . "\n"
                                    . "Data da Primeira Avaliação: " . date("d-m-Y", strtotime($user_data['data_primeira_avaliacao'])) . "\n\n"
                                    . "Peso: " . number_format($user_data['media_peso'], 2) . " kg (" . number_format(calcularEvolucao($user_data['media_peso'], $user_data['peso_inicial']), 2) . "%)\n"
                                    . "Peitoral: " . number_format($user_data['media_peitoral'], 2) . " cm (" . number_format(calcularEvolucao($user_data['media_peitoral'], $user_data['peitoral_inicial']), 2) . "%)\n"
                                    . "Braço Esquerdo: " . number_format($user_data['media_braco_esq'], 2) . " cm (" . number_format(calcularEvolucao($user_data['media_braco_esq'], $user_data['braco_esq_inicial']), 2) . "%)\n"
                                    . "Braço Direito: " . number_format($user_data['media_braco_dir'], 2) . " cm (" . number_format(calcularEvolucao($user_data['media_braco_dir'], $user_data['braco_dir_inicial']), 2) . "%)\n"
                                    . "Cintura: " . number_format($user_data['media_cintura'], 2) . " cm (" . number_format(calcularEvolucao($user_data['media_cintura'], $user_data['cintura_inicial']), 2) . "%)\n"
                                    . "Abdômen: " . number_format($user_data['media_abdomen'], 2) . " cm (" . number_format(calcularEvolucao($user_data['media_abdomen'], $user_data['abdomen_inicial']), 2) . "%)\n"
                                    . "Quadril: " . number_format($user_data['media_quadril'], 2) . " cm (" . number_format(calcularEvolucao($user_data['media_quadril'], $user_data['quadril_inicial']), 2) . "%)\n"
                                    . "Coxa Esquerda: " . number_format($user_data['media_coxa_esq'], 2) . " cm (" . number_format(calcularEvolucao($user_data['media_coxa_esq'], $user_data['coxa_esq_inicial']), 2) . "%)\n"
                                    . "Coxa Direita: " . number_format($user_data['media_coxa_dir'], 2) . " cm (" . number_format(calcularEvolucao($user_data['media_coxa_dir'], $user_data['coxa_dir_inicial']), 2) . "%)\n"
                                    . "Panturrilha Esquerda: " . number_format($user_data['media_panturrilha_esq'], 2) . " cm (" . number_format(calcularEvolucao($user_data['media_panturrilha_esq'], $user_data['panturrilha_esq_inicial']), 2) . "%)\n"
                                    . "Panturrilha Direita: " . number_format($user_data['media_panturrilha_dir'], 2) . " cm (" . number_format(calcularEvolucao($user_data['media_panturrilha_dir'], $user_data['panturrilha_dir_inicial']), 2) . "%)\n"
                                    . "Objetivo: " . $user_data['objetivo_avaliacao'];

                                // Codifica a mensagem para a URL
                                $mensagem_url = urlencode($mensagem);


                                $evolucao_peso = calcularEvolucao($user_data['media_peso'], $user_data['peso_inicial']);
                                $evolucao_peitoral = calcularEvolucao($user_data['media_peitoral'], $user_data['peitoral_inicial']);
                                $evolucao_braco_esq = calcularEvolucao($user_data['media_braco_esq'], $user_data['braco_esq_inicial']);
                                $evolucao_braco_dir = calcularEvolucao($user_data['media_braco_dir'], $user_data['braco_dir_inicial']);
                                $evolucao_cintura = calcularEvolucao($user_data['media_cintura'], $user_data['cintura_inicial']);
                                $evolucao_abdomen = calcularEvolucao($user_data['media_abdomen'], $user_data['abdomen_inicial']);
                                $evolucao_quadril = calcularEvolucao($user_data['media_quadril'], $user_data['quadril_inicial']);
                                $evolucao_coxa_esq = calcularEvolucao($user_data['media_coxa_esq'], $user_data['coxa_esq_inicial']);
                                $evolucao_coxa_dir = calcularEvolucao($user_data['media_coxa_dir'], $user_data['coxa_dir_inicial']);
                                $evolucao_panturrilha_esq = calcularEvolucao($user_data['media_panturrilha_esq'], $user_data['panturrilha_esq_inicial']);
                                $evolucao_panturrilha_dir = calcularEvolucao($user_data['media_panturrilha_dir'], $user_data['panturrilha_dir_inicial']);

                                echo "<tr>";
                                echo "<td>" . $user_data['nome_avaliacao'] . "</td>";
                                echo "<td>" . number_format($user_data['media_peso'], 2) . " kg (" . number_format($evolucao_peso, 2) . "%)</td>";
                                echo "<td>" . number_format($user_data['media_peitoral'], 2) . " cm (" . number_format($evolucao_peitoral, 2) . "%)</td>";
                                echo "<td>" . number_format($user_data['media_braco_esq'], 2) . " cm (" . number_format($evolucao_braco_esq, 2) . "%)</td>";
                                echo "<td>" . number_format($user_data['media_braco_dir'], 2) . " cm (" . number_format($evolucao_braco_dir, 2) . "%)</td>";
                                echo "<td>" . number_format($user_data['media_cintura'], 2) . " cm (" . number_format($evolucao_cintura, 2) . "%)</td>";
                                echo "<td>" . number_format($user_data['media_abdomen'], 2) . " cm (" . number_format($evolucao_abdomen, 2) . "%)</td>";
                                echo "<td>" . number_format($user_data['media_quadril'], 2) . " cm (" . number_format($evolucao_quadril, 2) . "%)</td>";
                                echo "<td>" . number_format($user_data['media_coxa_esq'], 2) . " cm (" . number_format($evolucao_coxa_esq, 2) . "%)</td>";
                                echo "<td>" . number_format($user_data['media_coxa_dir'], 2) . " cm (" . number_format($evolucao_coxa_dir, 2) . "%)</td>";
                                echo "<td>" . number_format($user_data['media_panturrilha_esq'], 2) . " cm (" . number_format($evolucao_panturrilha_esq, 2) . "%)</td>";
                                echo "<td>" . number_format($user_data['media_panturrilha_dir'], 2) . " cm (" . number_format($evolucao_panturrilha_dir, 2) . "%)</td>";
                                echo "<td>" . $user_data['objetivo_avaliacao'] . "</td>";
                                echo "<td class='acoes'>
                                            <a class='btn-share' href='https://api.whatsapp.com/send?text=$mensagem_url' target='_blank'><i class='bx bx-share'></i></a>
                                        </td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>

                </div>

            </div>

        </main>
    </div>

    <script src="script.js">
    </script>
</body>

</html>