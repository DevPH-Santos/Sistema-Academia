<?php
if (!empty($_GET['pk_cod_avaliacao'])) {

    define('APP_RUNNING', true);
    require_once('../src/config.php');
    
    $pk_cod_avaliacao = $_GET['pk_cod_avaliacao'];
    $sqlSelect = "SELECT * FROM avaliacao WHERE pk_cod_avaliacao=$pk_cod_avaliacao";
    $result = $conexao->query($sqlSelect);

    if ($result->num_rows > 0) {
        while ($user_data = mysqli_fetch_assoc($result)) {
            $nome_avaliacao = $user_data['nome_avaliacao'];
            $peso_avaliacao = $user_data['peso_avaliacao'];
            $peito_avaliacao = $user_data['peito_avaliacao'];
            $braco_esq_avaliacao = $user_data['braco_esq_avaliacao'];
            $braco_dir_avaliacao = $user_data['braco_dir_avaliacao'];
            $cintura_avaliacao = $user_data['cintura_avaliacao'];
            $abdomen_avaliacao = $user_data['abdomen_avaliacao'];
            $quadril_avaliacao = $user_data['quadril_avaliacao'];
            $coxa_esq_avaliacao = $user_data['coxa_esq_avaliacao'];
            $coxa_dir_avaliacao = $user_data['coxa_dir_avaliacao'];
            $panturrilha_esq_avaliacao = $user_data['panturrilha_esq_avaliacao'];
            $panturrilha_dir_avaliacao = $user_data['panturrilha_dir_avaliacao'];
            $objetivo_avaliacao = $user_data['objetivo_avaliacao'];
            $data_avaliacao = date('Y-m-d', strtotime($user_data['data_avaliacao'])); // Ajuste para o formato correto
        }
    } else {
        header('Location: ../progressos.php');
    }
} else {
    header('Location: ../progressos.php');
}
?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

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
            overflow-y: auto;
        }

        main {
            padding: 55px 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .form-container {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-container form {
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

        .form-container form label {
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

        @media screen and (max-width: 768px) {
            .container {
                padding-top: 10px;
            }

            .form-container form input {
                width: 300px;
            }
        }
    </style>

    <title>Dashboard | Edição de progressos</title>
</head>

<body>

    <div class="container">

        <main>

            <div class="form-container">

                <!--Aqui será feito o formulário das avaliações-->
                <form action="saveeditprogressos.php" method="post" id="avaliacoes">

                    <p>Digite o valor dos campos abaixo:</p>

                    <div>
                        <label for="nome_avaliacao">Nome:</label>
                        <input type="text" name="nome_avaliacao" id="nome_avaliacao" value="<?php echo $nome_avaliacao ?>" required>
                    </div>

                    <div>
                        <label for="peso_avaliacao">Peso:</label>
                        <input type="number" name="peso_avaliacao" step="0.01" id="peso_avaliacao" min="0" value="<?php echo $peso_avaliacao; ?>" required>
                    </div>

                    <div>
                        <label for="peito_avaliacao">Peitoral:</label>
                        <input type="number" name="peito_avaliacao" step="0.01" id="peito_avaliacao" min="0" value="<?php echo $peito_avaliacao ?>" required>
                    </div>

                    <div>
                        <label for="braco_esq_avaliacao">Braço esquerdo:</label>
                        <input type="number" name="braco_esq_avaliacao" step="0.01" id="braco_esq_avaliacao" min="0" value="<?php echo $braco_esq_avaliacao ?>" required>
                    </div>

                    <div>
                        <label for="braco_dir_avaliacao">Braço direito:</label>
                        <input type="number" name="braco_dir_avaliacao" step="0.01" id="braco_dir_avaliacao" min="0" value="<?php echo $braco_dir_avaliacao ?>" required>
                    </div>

                    <div>
                        <label for="cintura_avaliacao">Cintura:</label>
                        <input type="number" name="cintura_avaliacao" step="0.01" id="cintura_avaliacao" min="0" value="<?php echo $cintura_avaliacao ?>" required>
                    </div>

                    <div>
                        <label for="abdomen_avaliacao">Abdômen:</label>
                        <input type="number" name="abdomen_avaliacao" step="0.01" id="abdomen_avaliacao" min="0" value="<?php echo $abdomen_avaliacao ?>" required>
                    </div>

                    <div>
                        <label for="quadril_avaliacao">Quadril:</label>
                        <input type="number" name="quadril_avaliacao" step="0.01" id="quadril_avaliacao" min="0" value="<?php echo $quadril_avaliacao ?>" required>
                    </div>

                    <div>
                        <label for="coxa_esq_avaliacao">Coxa esquerda:</label>
                        <input type="number" name="coxa_esq_avaliacao" step="0.01" id="coxa_esq_avaliacao" min="0" value="<?php echo $coxa_esq_avaliacao ?>" required>
                    </div>

                    <div>
                        <label for="coxa_dir_avaliacao">Coxa direita:</label>
                        <input type="number" name="coxa_dir_avaliacao" step="0.01" id="coxa_dir_avaliacao" min="0" value="<?php echo $coxa_dir_avaliacao ?>" required>
                    </div>

                    <div>
                        <label for="panturrilha_esq_avaliacao">Panturrilha esquerda:</label>
                        <input type="number" name="panturrilha_esq_avaliacao" step="0.01" id="panturrilha_esq_avaliacao" min="0" value="<?php echo $panturrilha_esq_avaliacao ?>" required>
                    </div>

                    <div>
                        <label for="panturrilha_dir_avaliacao">Panturrilha direita:</label>
                        <input type="number" name="panturrilha_dir_avaliacao" step="0.01" id="panturrilha_dir_avaliacao" min="0" value="<?php echo $panturrilha_dir_avaliacao ?>" required>
                    </div>

                    <div>
                        <label for="objetivo_avaliacao">Digite o objetivo do cliente:</label>
                        <small>Exemplo: Perder peso</small>
                        <small>Não obrigatório</small>
                        <input type="text" name="objetivo_avaliacao" id="objetivo_avaliacao" value="<?php echo $objetivo_avaliacao ?>">
                    </div>


                    <div>
                        <label for="data_avaliacao">Data da avaliação:</label>
                        <small>Avaliação de hoje</small>
                        <input type="date" name="data_avaliacao" id="data_avaliacao" value="<?php echo $data_avaliacao ?>" required>

                        <input type="hidden" name="pk_cod_avaliacao" value="<?php echo $pk_cod_avaliacao; ?>">

                    </div>


                    <input type="submit" value="Enviar" name="update_avaliacao">

                </form>

            </div>

        </main>

    </div>

</body>

</html>