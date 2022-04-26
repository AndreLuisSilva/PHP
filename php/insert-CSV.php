<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$bd = "gelopar";

$con = new mysqli($servidor, $usuario, $senha, $bd);
mysqli_set_charset($con, "utf8");

$location = 'gelopar/php/';
$arquivo = $_FILES["file"]["tmp_name"];
$nome = $_FILES["file"]["name"];

$count_lines = 0;
$count_insert = 0;
$count_update = 0;
$validate = false;

$ext = explode(".", $nome);

$extensao = end($ext);

if ($extensao != "csv")
{
    echo "Extensão Inválida!";
}
else
{
    $objeto = fopen($arquivo, 'r');

    while (($dados = fgetcsv($objeto, 1000, ",")) !== false)
    {
        $id = utf8_encode($dados[0]);
        $codigo = utf8_encode($dados[1]);
        $produto = utf8_encode($dados[2]);
        $estoque_fabrica = utf8_encode($dados[3]);
        $preco = utf8_encode($dados[4]);

        $count_lines = $count_lines + 1;

        $sql = "SELECT * FROM produtos WHERE codigo = '$codigo'";

        if ($result = mysqli_query($con, $sql))
        {

            $rowcount = mysqli_num_rows($result);

            if ($rowcount == 0)
            {
                //Inserir o usuário no BD
                $result_insert = "INSERT INTO produtos (id, codigo, produto, estoque_fabrica, preco) VALUES ('$id', '$codigo', '$produto', '$estoque_fabrica', '$preco')";
                if ($con->query($result_insert) === true)
                {
                    #echo "Insert realizado com sucesso!";
                    $count_insert = $count_insert + 1;
                    $validate = true;
                }
                else
                {
                    echo "Insert Error: " . $sql . "<br>" . $conn->error;
                    exit();
                }
            }
            else
            {
                $result_update = "UPDATE produtos SET id = '$id', produto = '$produto', estoque_fabrica = '$estoque_fabrica', preco = '$preco' WHERE codigo = '$codigo'";
                if ($con->query($result_update) === true)
                {
                    #echo "Update realizado com sucesso!";
                    $count_update = $count_update + 1;
                }
                else
                {
                    echo "Update Error: " . $sql . "<br>" . $conn->error;
                    exit();
                }
            }

        }

    }

    if (($count_lines == $count_insert) || ($count_lines == $count_update))
    {
        if ($validate == true)
        {
            echo "Insert realizado com sucesso!";
        }
        else if ($validate == false)
        {
            echo "Update realizado com sucesso!";
        }
    }
    else
    {
        echo "Alterações realizadas com sucesso na base de dados!";
    }

}
?>
