
<?php
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

// Consultar dados
$sql = 'SELECT valor, descricao, coment, data, hora FROM gastos';
$result = $conn->query($sql);

if ($result === false) {
    die("Erro na consulta: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="table.css">
    <link rel="stylesheet" href="style.css">
    <title>Dados dos Gastos</title>
</head>
<body>
    <header>
        <h1>Controle de Gastos</h1>
        <h2>Stephanie / Lucas</h2>
    </header>
    <table>
        <thead>
            <tr>
                <th>Valor</th>
                <th>Descrição</th>
                <th>Comentário</th>
                <th>Data</th>
                <th>Hora</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['valor']); ?></td>
                    <td><?php echo htmlspecialchars($row['descricao']); ?></td>
                    <td><?php echo htmlspecialchars($row['coment']); ?></td>
                    <td><?php echo htmlspecialchars($row['data']); ?></td>
                    <td><?php echo htmlspecialchars($row['hora']); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>

<?php
$conn->close();
?>