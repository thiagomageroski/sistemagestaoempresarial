<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4361ee;
            --primary-dark: #3a0ca3;
            --primary-light: #4895ef;
            --accent-color: #7209b7;
            --success-color: #06d6a0;
            --danger-color: #ef476f;
            --dark-color: #2d3142;
            --light-color: #f8f9fa;
            --gray-light: #e9ecef;
            --border-radius: 12px;
            --card-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4eaf1 100%);
            color: var(--dark-color);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .login-container {
            width: 100%;
            max-width: 450px;
            animation: fadeIn 0.8s ease;
        }

        .login-card {
            background: white;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
        }

        .login-card:hover {
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        .card-header {
            background: linear-gradient(120deg, var(--primary-color), var(--primary-dark));
            color: white;
            text-align: center;
            padding: 2rem;
        }

        .card-header h1 {
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 1.8rem;
        }

        .card-header p {
            opacity: 0.9;
            font-size: 0.95rem;
        }

        .card-body {
            padding: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--dark-color);
            font-size: 0.95rem;
        }

        .input-group {
            position: relative;
        }

        .form-control {
            width: 100%;
            padding: 0.875rem 1rem;
            font-size: 1rem;
            border: 2px solid var(--gray-light);
            border-radius: var(--border-radius);
            background-color: var(--light-color);
            transition: var(--transition);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
        }

        .input-icon {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary-color);
            font-size: 1.1rem;
        }

        .btn-login {
            width: 100%;
            padding: 0.875rem 1.5rem;
            background: linear-gradient(to right, var(--primary-color), var(--primary-dark));
            color: white;
            border: none;
            border-radius: var(--border-radius);
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 4px 10px rgba(67, 97, 238, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(67, 97, 238, 0.4);
            background: linear-gradient(to right, var(--primary-dark), var(--accent-color));
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .alert {
            padding: 1rem;
            border-radius: var(--border-radius);
            margin-top: 1.5rem;
            animation: slideIn 0.5s ease;
        }

        .alert-danger {
            background-color: rgba(239, 71, 111, 0.1);
            border: 1px solid rgba(239, 71, 111, 0.2);
            color: var(--danger-color);
        }

        .alert ul {
            margin-bottom: 0;
            padding-left: 1rem;
        }

        .alert li {
            margin-bottom: 0.25rem;
        }

        .alert li:last-child {
            margin-bottom: 0;
        }

        /* Decoração adicional */
        .login-decoration {
            position: absolute;
            z-index: -1;
            opacity: 0.05;
        }

        .decoration-1 {
            top: 10%;
            left: 10%;
            font-size: 8rem;
            color: var(--primary-color);
        }

        .decoration-2 {
            bottom: 10%;
            right: 10%;
            font-size: 6rem;
            color: var(--primary-dark);
        }

        /* Animações */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Responsividade */
        @media (max-width: 576px) {
            body {
                padding: 1rem;
            }
            
            .login-container {
                max-width: 100%;
            }
            
            .card-header, .card-body {
                padding: 1.5rem;
            }
            
            .decoration-1, .decoration-2 {
                display: none;
            }
        }

        /* Efeitos de foco melhorados */
        .form-control:focus + .input-icon {
            color: var(--primary-dark);
            animation: bounce 0.5s ease;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(-50%); }
            50% { transform: translateY(-60%); }
        }

        /* Placeholder styling */
        .form-control::placeholder {
            color: #a0a0a0;
            font-size: 0.95rem;
        }
    </style>
</head>
<body>
    <i class="fas fa-lock login-decoration decoration-1"></i>
    <i class="fas fa-key login-decoration decoration-2"></i>

    <div class="login-container">
        <div class="login-card">
            <div class="card-header">
                <h1>Acesso Administrativo</h1>
                <p>Entre com suas credenciais para continuar</p>
            </div>
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <label for="email" class="form-label">E-mail</label>
                        <div class="input-group">
                            <input type="email" id="email" class="form-control" placeholder="admin@empresa.com" value="">
                            <i class="fas fa-envelope input-icon"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="senha" class="form-label">Senha</label>
                        <div class="input-group">
                            <input type="password" id="senha" class="form-control" placeholder="admin123" value="">
                            <i class="fas fa-lock input-icon"></i>
                        </div>
                    </div>

                    <button type="submit" class="btn-login">
                        <i class="fas fa-sign-in-alt"></i> Entrar
                    </button>
                </form>

                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <li>O campo e-mail é obrigatório</li>
                        <li>A senha deve ter pelo menos 6 caracteres</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Adicionando interatividade aos inputs
        document.querySelectorAll('.form-control').forEach(input => {
            // Adicionar classe quando o input estiver preenchido
            input.addEventListener('blur', function() {
                if (this.value) {
                    this.classList.add('has-value');
                } else {
                    this.classList.remove('has-value');
                }
            });
            
            // Animar ícone ao focar no input
            input.addEventListener('focus', function() {
                this.parentElement.querySelector('.input-icon').style.animation = 'bounce 0.5s ease';
            });
        });
    </script>
</body>
</html>