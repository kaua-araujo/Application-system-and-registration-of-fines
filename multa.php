<!DOCTYPE html>
<html lang="PT-BR">

<head>
    <meta charset="UTF-8">
    <title>Multa</title>
</head>
<body>
    <div>
        <form method="POST" action="<?= $_SERVER['PHP_SELF']; ?>">
            <label for="User">Placa do carro:</label>
            <input type="text" name="placa" placeholder="XXXX-XXXX" required>
            <br>
            <br>
            <label for="User">Nome da rua:</label>
            <input type="text" name="rua" placeholder="Rua:" required>
            <br>
            <br>
            <label for="User">Velocidade maxima da rua:</label>
            <input type="text" name="velrua" placeholder="KM" required>
            <br>
            <br>
            <label for="User">Velocidade que o motorista estava:</label>
            <input type="text" name="velmot" placeholder="KM" required>
            <br>
            <br>
            <input type="submit" name="multa" value="Calcular Multa">
            <input type="submit" name="relatorio" value="Relatório de multas">
        </form>
    </div>
</body>
</html>
<?php
    $velocidaderua = !empty($_POST['velrua']) ? $_POST['velrua'] : 0;
    $velocidademotorista = !empty($_POST['velmot']) ? $_POST['velmot'] : 0;

        if (isset($_POST["multa"])) {
            $resulMulta = calculoMulta($velocidademotorista - $velocidaderua);
            relatorio($resulMulta);
        }

        if (isset($_POST["relatorio"])) {
            leitura();
        }

        function calculoMulta(int $excesso)
        {
            $multa = 0;

            if ($excesso < 0) {
                $multa = 0;
            }
            if ($excesso > 0 and $excesso <= 10) {
                $multa = 50;
            }
            if ($excesso > 10 and $excesso <= 30) {
                $multa = 100;
            }
            if ($excesso > 30) {
                $multa = 200;
            }

            return $multa;
        }

        function relatorio(int $multa)
        {
            $placa = $_POST['placa'];
            $rua = $_POST['rua'];
            $velocidaderua = $_POST['velrua'];
            $velocidademotorista = $_POST['velmot'];

            echo "Placa do Carro: $placa";
            ?> <br> <?php
            echo "Rua: $rua";
            ?> <br> <?php
            echo "Velocidade máxima da rua: $velocidaderua";
            ?> <br> <?php
            echo "Velocidade de motorista: $velocidademotorista";
            ?> <br> <?php
            echo "Valor da multa: R$ $multa";

            $frase = "Placa: $placa   Rua: $rua  Velocidade da rua: $velocidaderua Km  Velocidade do motorista: $velocidademotorista Km  Multa: R$$multa\r\n";
            $fp = fopen('registros.txt', "a");
            fwrite($fp, $frase);
            fclose($fp);
        }
        function leitura(){
            echo "<h5>Relatório de multas</h5>";
            $fp = fopen('registros.txt', "r");
            while(!feof($fp)){
            echo fgets($fp),"<br>";        
        }
            fclose($fp);
        }
