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
            <input  type="text" name="placa"  placeholder="XXXX-XXXX">
            <br>
            <br>
            <label for="User">Nome da rua:</label>
            <input  type="text" name="rua"  placeholder="Rua:">
            <br>
            <br>            
            <label for="User">Velocidade maxima da rua:</label>
            <input type="text" name="velrua" placeholder="KM">
            <br>
            <br>
            <label for="User">Velocidade que o motorista estava:</label>
            <input type="text" name="velmot" placeholder="KM">
            <br>
            <br>
            <input type="submit" name = "multa" value="Calcular Multa">
        </form>
    </div>
</body>
</html>

<?php
    if(isset($_POST["multa"])){
        calculoMulta();
    }
    function calculoMulta(){
        $placa = $_POST['placa'];
        $rua = $_POST['rua'];
        $velocidaderua = $_POST['velrua'];
        $velocidademotorista = $_POST['velmot'];
        $excesso = $velocidademotorista - $velocidaderua;
            if($excesso < 0){
                $multa = 0;
            }
            if($excesso > 0 and $excesso <= 10){
                $multa = 50;
            }
            if($excesso >10 and $excesso <= 30){
                $multa = 100;
            }
            if($excesso >30){
                $multa = 200;
            }
            relatorio();
    }
    function relatorio(){
        $placa = $_POST['placa'];
        $rua = $_POST['rua'];
        $velocidaderua = $_POST['velrua'];
        $velocidademotorista = $_POST['velmot'];
        $excesso = $velocidademotorista - $velocidaderua;
        
        if($excesso < 0){
            $multa = 0;
        }
        if($excesso > 0 and $excesso <= 10){
            $multa = 50;
        }
        if($excesso >10 and $excesso <= 30){
            $multa = 100;
        }
        if($excesso >30){
            $multa = 200;
        }
        ?> <br> <?
        echo "Placa do Carro: $placa";
        ?> <br> <?
        echo "Rua: $rua";
        ?> <br> <?
        echo "Velocidade máxima da rua: $velocidaderua";
        ?> <br> <?
        echo "Velocidade de motorista: $velocidademotorista";
        ?> <br> <?
        echo "Valor da multa: R$ $multa";
        

        $frase = "O carro de placa: $placa Teve uma multa no valor de: R$$multa na Rua: $rua\r\n";
        $fp = fopen('registros.txt', "a");
        fwrite($fp, $frase);
        fclose($fp);
    }