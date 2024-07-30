<?php 

// Verifique se os dados foram enviados
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Pegando dados vindos do formulário e sanitizando-os
    $valor = isset($_POST['valor']) ? filter_var($_POST['valor'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) : null;
    $desc = isset($_POST['desc']) ? filter_var($_POST['desc'], FILTER_SANITIZE_STRING) : null;
    $coment = isset($_POST['coment']) ? filter_var($_POST['coment'], FILTER_SANITIZE_STRING) : null;
    $data_atual = date('Y-m-d');
    $hora_atual = date('H:i:s');

    // Configuração de credenciais 
    $server = 'localhost';
    $usuario = 'root';
    $senha = '';
    $banco = 'money_control';

    // Conexão com o banco de dados
    $conn = new mysqli($server, $usuario, $senha, $banco);

    if ($conn->connect_error) {
        die("Falha ao comunicar-se ao banco de dados: " . $conn->connect_error);
    }

    // Preparando e executando a consulta
    $stmt = $conn->prepare("INSERT INTO gastos (valor, descricao, coment, data, hora) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $valor, $desc, $coment, $data_atual, $hora_atual);

    if ($stmt->execute()) {
        header("Location: table_data.php"); // Redireciona para sucesso.php
    exit(); // Termina o script atual para evitar execução adicional
    } else {
        echo "Erro ao enviar informações: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Dados do formulário não foram enviados corretamente.";
}
?>