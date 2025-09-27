<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Componente de Input Estilizado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4361ee;
            --primary-dark: #3a0ca3;
            --primary-light: #4895ef;
            --success-color: #06d6a0;
            --danger-color: #ef476f;
            --warning-color: #ffd166;
            --dark-color: #2d3142;
            --light-color: #f8f9fa;
            --gray-light: #e9ecef;
            --gray-medium: #ced4da;
            --text-muted: #6c757d;
            --border-radius: 10px;
            --transition: all 0.3s ease;
            --focus-shadow: 0 0 0 4px rgba(67, 97, 238, 0.15);
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

        .form-container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            padding: 2.5rem;
            width: 100%;
            max-width: 500px;
        }

        .form-title {
            text-align: center;
            margin-bottom: 2rem;
            color: var(--dark-color);
            font-weight: 700;
            position: relative;
            padding-bottom: 0.75rem;
        }

        .form-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: linear-gradient(to right, var(--primary-color), var(--primary-dark));
            border-radius: 2px;
        }

        /* Estilização do componente de input */
        .input-group {
            margin-bottom: 1.75rem;
            position: relative;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--dark-color);
            font-size: 0.95rem;
            transition: var(--transition);
        }

        .input-container {
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
            position: relative;
            z-index: 2;
        }

        .form-control::placeholder {
            color: #a0a0a0;
            font-size: 0.95rem;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: var(--focus-shadow);
            background-color: white;
        }

        /* Estado de erro */
        .is-invalid {
            border-color: var(--danger-color) !important;
            box-shadow: 0 0 0 4px rgba(239, 71, 111, 0.15) !important;
        }

        .invalid-feedback {
            display: block;
            margin-top: 0.5rem;
            color: var(--danger-color);
            font-size: 0.85rem;
            font-weight: 500;
            animation: slideIn 0.3s ease;
        }

        /* Ícones para diferentes tipos de input */
        .input-icon {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary-color);
            font-size: 1.1rem;
            z-index: 3;
            transition: var(--transition);
        }

        .form-control:focus + .input-icon {
            color: var(--primary-dark);
            animation: bounce 0.5s ease;
        }

        /* Efeito de label flutuante (opcional) */
        .floating-label {
            position: absolute;
            top: 0.875rem;
            left: 1rem;
            font-size: 1rem;
            color: var(--text-muted);
            pointer-events: none;
            transition: var(--transition);
            z-index: 1;
        }

        .form-control:focus ~ .floating-label,
        .form-control:not(:placeholder-shown) ~ .floating-label {
            top: -0.5rem;
            left: 0.75rem;
            font-size: 0.75rem;
            background: white;
            padding: 0 0.5rem;
            color: var(--primary-color);
            font-weight: 600;
            z-index: 4;
        }

        /* Animações */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(-50%); }
            50% { transform: translateY(-60%); }
        }

        /* Decoração visual para o container de exemplo */
        .input-examples {
            display: grid;
            gap: 1.5rem;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid var(--gray-light);
        }

        .example-title {
            font-size: 0.9rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.75rem;
        }

        /* Estados de sucesso (para validação positiva) */
        .is-valid {
            border-color: var(--success-color) !important;
            box-shadow: 0 0 0 4px rgba(6, 214, 160, 0.15) !important;
        }

        .valid-feedback {
            display: block;
            margin-top: 0.5rem;
            color: var(--success-color);
            font-size: 0.85rem;
            font-weight: 500;
        }

        /* Responsividade */
        @media (max-width: 576px) {
            .form-container {
                padding: 1.5rem;
            }
            
            .form-title {
                font-size: 1.5rem;
            }
        }

        /* Efeitos de foco para acessibilidade */
        .form-control:focus {
            outline: 2px solid transparent;
        }

        /* Estilos para diferentes tipos de input */
        input[type="password"] {
            letter-spacing: 0.1em;
        }

        input[type="email"] {
            text-transform: lowercase;
        }

        /* Estado desabilitado */
        .form-control:disabled {
            background-color: var(--gray-light);
            color: var(--text-muted);
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2 class="form-title">Componente de Input</h2>
        
        <!-- Input básico com label -->
        <div class="input-group">
            <label for="nome" class="form-label">Nome completo</label>
            <div class="input-container">
                <input
                    id="nome"
                    name="nome"
                    type="text"
                    value=""
                    placeholder="Digite seu nome completo"
                    class="form-control"
                >
                <i class="fas fa-user input-icon"></i>
            </div>
        </div>

        <!-- Input com erro -->
        <div class="input-group">
            <label for="email" class="form-label">E-mail</label>
            <div class="input-container">
                <input
                    id="email"
                    name="email"
                    type="email"
                    value="email-invalido"
                    placeholder="seu@email.com"
                    class="form-control is-invalid"
                >
                <i class="fas fa-envelope input-icon"></i>
            </div>
            <div class="invalid-feedback">Por favor, insira um e-mail válido.</div>
        </div>

        <!-- Input com sucesso -->
        <div class="input-group">
            <label for="telefone" class="form-label">Telefone</label>
            <div class="input-container">
                <input
                    id="telefone"
                    name="telefone"
                    type="tel"
                    value="(11) 99999-9999"
                    placeholder="(00) 00000-0000"
                    class="form-control is-valid"
                >
                <i class="fas fa-phone input-icon"></i>
            </div>
            <div class="valid-feedback">Telefone válido!</div>
        </div>

        <div class="input-examples">
            <div class="example-title">Mais exemplos</div>
            
            <!-- Input com placeholder flutuante -->
            <div class="input-group">
                <div class="input-container">
                    <input
                        id="empresa"
                        name="empresa"
                        type="text"
                        value=""
                        placeholder=" "
                        class="form-control"
                    >
                    <span class="floating-label">Nome da empresa</span>
                    <i class="fas fa-building input-icon"></i>
                </div>
            </div>

            <!-- Input de senha -->
            <div class="input-group">
                <label for="senha" class="form-label">Senha</label>
                <div class="input-container">
                    <input
                        id="senha"
                        name="senha"
                        type="password"
                        value=""
                        placeholder="Digite sua senha"
                        class="form-control"
                    >
                    <i class="fas fa-lock input-icon"></i>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Adicionando interatividade
        document.addEventListener('DOMContentLoaded', function() {
            // Adicionar classe quando o input estiver preenchido
            document.querySelectorAll('.form-control').forEach(input => {
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

            // Simular validação em tempo real
            const emailInput = document.getElementById('email');
            emailInput.addEventListener('input', function() {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (emailRegex.test(this.value)) {
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                } else {
                    this.classList.remove('is-valid');
                    this.classList.add('is-invalid');
                }
            });
        });
    </script>
</body>
</html>