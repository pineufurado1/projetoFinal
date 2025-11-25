
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Painel Principal</title>
<style>
    /* Reset básico */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    

    body {
        background: #1A75FF; /* azul vívido */
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        color: #fff;
    }

    /* Header */
    header {
        background: #005CE6;
        color: white;
        padding: 20px 40px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 5px 6px rgba(0,0,0,0.1);
    }

    header img {
        height: 100px;
    }

    header h1 {
        font-size: 24px;
        font-weight: bold;
    }

    /* Container externo com borda */
    .container-wrapper {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 40px 20px;
    }

    .container-border {
        border: 3px solid rgba(255, 255, 255, 0.5);
        border-radius: 20px;
        padding: 30px;
        width: 100%;
        max-width: 950px;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 30px;
        background: rgba(0,0,0,0.05); /* leve transparência atrás dos cards */
    }

    /* Cards dos CRUDs */
    .card {
        background: #007BFF;
        width: 100%;
        height: 150px;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.25);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        cursor: pointer;
        transition: transform 0.3s, box-shadow 0.3s, background 0.3s;
    }

    .card:hover {
        transform: translateY(-10px) scale(1.05);
        box-shadow: 0 16px 35px rgba(0,0,0,0.3);
        background: #3399FF;
        animation: pulse 1s infinite alternate;
    }

    @keyframes pulse {
        0% { transform: translateY(-10px) scale(1.05); }
        100% { transform: translateY(-12px) scale(1.08); }
    }

    .card h3 {
        margin-bottom: 10px;
        color: #fff;
        text-transform: uppercase;
    }

    .card p {
        color: #e0e0e0;
        font-size: 14px;
    }

    /* Footer */
    footer {
        text-align: center;
        padding: 20px;
        color: #cce6ff;
        font-size: 14px;
        background: #005CE6;
    }

    @media(max-width: 768px){
        .container-border {
            grid-template-columns: 1fr;
        }
    }
</style>
</head>
<body>
    <header>
       <img src="logo.png" width="100" height="300">
 
        <h1>Painel Principal do Sistema</h1>
    </header>

    <div class="container-wrapper">
        <div class="container-border">
            <div class="card" onclick="window.location.href='../crud2/index.php'">
                <h3>Atividades</h3>
                <p>Gerencie os produtos cadastrados</p>
            </div>

            <div class="card" onclick="window.location.href='../crud1/index.php'">
                <h3>Alunos</h3>
                <p>Cadastre e atualize informações dos alunos</p>
            </div>

            <div class="card" onclick="window.location.href='../crud3/index.php'">
                <h3>Professores</h3>
                <p>Controle de dados de funcionários</p>
            </div>

            <div class="card" onclick="window.location.href='../crud4/index.php'">
                <h3>Relatórios</h3>
                <p>Visualize e registre vendas</p>
            </div>
        </div>
    </div>

    <footer>
        © 2025 Meu Sistema - Todos os direitos reservados
    </footer>
</body>
</html>

