<?php
// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura os dados do formulário
    $nome = isset($_POST['nome']) ? htmlspecialchars($_POST['nome']) : '';
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
    $mensagem = isset($_POST['mensagem']) ? htmlspecialchars($_POST['mensagem']) : '';
    
    // Validações básicas
    $erros = [];
    
    if (empty($nome)) {
        $erros[] = 'O nome é obrigatório.';
    }
    
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros[] = 'O email é obrigatório e deve ser válido.';
    }
    
    if (empty($mensagem)) {
        $erros[] = 'A mensagem é obrigatória.';
    }
} else {
    // Se não foi POST, redireciona para o formulário
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resposta do Formulário</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        h1 {
            color: #333;
            text-align: center;
        }
        
        .success {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
        }
        
        .error {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
        }
        
        .dados {
            background-color: #f9f9f9;
            padding: 15px;
            border-left: 4px solid #007bff;
            margin-bottom: 20px;
        }
        
        .dado-item {
            margin-bottom: 15px;
        }
        
        .dado-item strong {
            color: #007bff;
            display: block;
            margin-bottom: 5px;
        }
        
        .voltar {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
        }
        
        .voltar:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Resposta do Formulário</h1>
        
        <?php if (!empty($erros)): ?>
            <div class="error">
                <strong>Erros encontrados:</strong>
                <ul>
                    <?php foreach ($erros as $erro): ?>
                        <li><?php echo $erro; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <a href="index.php" class="voltar">Voltar ao Formulário</a>
        <?php else: ?>
            <div class="success">
                <strong>✓ Formulário enviado com sucesso!</strong>
            </div>
            
            <div class="dados">
                <div class="dado-item">
                    <strong>Nome:</strong>
                    <span><?php echo $nome; ?></span>
                </div>
                
                <div class="dado-item">
                    <strong>Email:</strong>
                    <span><?php echo $email; ?></span>
                </div>
                
                <div class="dado-item">
                    <strong>Mensagem:</strong>
                    <span><?php echo nl2br($mensagem); ?></span>
                </div>
            </div>
            
            <a href="index.php" class="voltar">Enviar Novo Formulário</a>
        <?php endif; ?>
    </div>
</body>
</html>
