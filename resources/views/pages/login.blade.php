<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de Gestão</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4361ee;
            --primary-dark: #3a0ca3;
            --primary-light: #4895ef;
            --secondary-color: #7209b7;
            --success-color: #06d6a0;
            --success-dark: #05b387;
            --warning-color: #ffd166;
            --danger-color: #ef476f;
            --dark-color: #2d3142;
            --light-color: #f8f9fa;
            --gray-light: #e9ecef;
            --text-muted: #6c757d;
            --border-radius: 12px;
            --border-radius-lg: 16px;
            --card-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            --card-shadow-hover: 0 30px 60px rgba(0, 0, 0, 0.15);
            --input-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            --transition: all 0.3s ease;
            --transition-slow: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: var(--dark-color);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            position: relative;
        }

        /* Botão Início */
        .home-button {
            position: absolute;
            top: 2rem;
            left: 2rem;
            z-index: 1000;
        }

        .btn-home {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            border: none;
            border-radius: var(--border-radius);
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            font-size: 1rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: var(--transition);
            cursor: pointer;
            box-shadow: 0 6px 20px rgba(67, 97, 238, 0.3);
            text-decoration: none;
            position: relative;
            overflow: hidden;
        }

        .btn-home::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: var(--transition);
        }

        .btn-home:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(67, 97, 238, 0.4);
            color: white;
            text-decoration: none;
        }

        .btn-home:hover::before {
            left: 100%;
        }

        .login-container {
            width: 100%;
            max-width: 450px;
            animation: fadeInUp 0.8s ease;
        }

        .login-card {
            background: white;
            border-radius: var(--border-radius-lg);
            box-shadow: var(--card-shadow);
            overflow: hidden;
            transition: var(--transition);
        }

        .login-card:hover {
            box-shadow: var(--card-shadow-hover);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            text-align: center;
            padding: 2.5rem 2rem;
            position: relative;
            overflow: hidden;
        }

        .card-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            animation: rotate 10s linear infinite;
        }

        .card-title {
            font-weight: 800;
            font-size: 2.2rem;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 2;
        }

        .card-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            position: relative;
            z-index: 2;
        }

        .card-body {
            padding: 2.5rem;
        }

        /* Formulário */
        .form-group {
            margin-bottom: 1.5rem;
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
            padding: 1rem 1.25rem;
            font-size: 1rem;
            border: 2px solid var(--gray-light);
            border-radius: var(--border-radius);
            background: var(--light-color);
            transition: var(--transition);
            position: relative;
            z-index: 2;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            background: white;
            box-shadow: 0 0 0 4px rgba(67, 97, 238, 0.15);
            transform: translateY(-2px);
        }

        .form-control::placeholder {
            color: #a0a0a0;
            font-size: 0.95rem;
        }

        .input-icon {
            position: absolute;
            right: 1.25rem;
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

        /* Botão de submit */
        .submit-container {
            text-align: center;
            margin-top: 2rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            border: none;
            border-radius: var(--border-radius);
            padding: 1.25rem 3rem;
            font-weight: 600;
            font-size: 1.1rem;
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            transition: var(--transition);
            cursor: pointer;
            box-shadow: 0 6px 20px rgba(67, 97, 238, 0.3);
            position: relative;
            overflow: hidden;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: var(--transition);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(67, 97, 238, 0.4);
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        /* Links adicionais */
        .auth-links {
            text-align: center;
            margin-top: 2rem;
            color: var(--text-muted);
        }

        .auth-links a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
            position: relative;
        }

        .auth-links a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary-color);
            transition: var(--transition);
        }

        .auth-links a:hover {
            color: var(--primary-dark);
        }

        .auth-links a:hover::after {
            width: 100%;
        }

        /* Checkbox lembrar */
        .form-check {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .form-check-input {
            width: 1.1em;
            height: 1.1em;
            border-radius: 4px;
            border: 2px solid var(--gray-light);
            cursor: pointer;
        }

        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .form-check-label {
            font-size: 0.95rem;
            color: var(--text-muted);
            cursor: pointer;
        }

        /* Validação visual */
        .is-invalid {
            border-color: var(--danger-color) !important;
            box-shadow: 0 0 0 4px rgba(239, 71, 111, 0.15) !important;
        }

        .is-valid {
            border-color: var(--success-color) !important;
            box-shadow: 0 0 0 4px rgba(6, 214, 160, 0.15) !important;
        }

        .invalid-feedback {
            display: block;
            margin-top: 0.5rem;
            color: var(--danger-color);
            font-size: 0.85rem;
            font-weight: 500;
            animation: slideIn 0.3s ease;
        }

        .valid-feedback {
            display: block;
            margin-top: 0.5rem;
            color: var(--success-color);
            font-size: 0.85rem;
            font-weight: 500;
        }

        /* Alertas */
        .alert {
            border-radius: var(--border-radius);
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            border: none;
            font-weight: 500;
        }

        .alert-warning {
            background-color: rgba(255, 209, 102, 0.2);
            color: #856404;
        }

        .alert-danger {
            background-color: rgba(239, 71, 111, 0.2);
            color: #721c24;
        }

        /* Animações */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-10px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(-50%); }
            50% { transform: translateY(-60%); }
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        /* Decoração */
        .decoration {
            position: absolute;
            z-index: -1;
            opacity: 0.05;
            font-size: 8rem;
            color: var(--primary-color);
        }

        .decoration-1 {
            top: 10%;
            left: 10%;
        }

        .decoration-2 {
            bottom: 10%;
            right: 10%;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .login-container {
                max-width: 100%;
                padding: 1rem;
            }
            
            .card-header {
                padding: 2rem 1.5rem;
            }
            
            .card-title {
                font-size: 2rem;
            }
            
            .card-body {
                padding: 2rem 1.5rem;
            }
            
            .btn-primary {
                width: 100%;
                justify-content: center;
            }

            .home-button {
                top: 1rem;
                left: 1rem;
            }

            .btn-home {
                padding: 0.6rem 1.2rem;
                font-size: 0.9rem;
            }
        }

        @media (max-width: 576px) {
            body {
                padding: 1rem;
            }
            
            .card-header {
                padding: 1.5rem 1rem;
            }
            
            .card-title {
                font-size: 1.8rem;
            }
            
            .card-body {
                padding: 1.5rem 1rem;
            }
            
            .form-control {
                padding: 0.875rem 1rem;
            }

            .home-button {
                top: 0.5rem;
                left: 0.5rem;
            }

            .btn-home {
                padding: 0.5rem 1rem;
                font-size: 0.85rem;
            }
        }

        /* Melhorias de acessibilidade */
        .form-control:focus {
            outline: 2px solid transparent;
        }

        .btn-primary:focus, .btn-home:focus {
            outline: 2px solid var(--primary-light);
            outline-offset: 2px;
        }

        /* Estados de loading */
        .btn-loading {
            position: relative;
            color: transparent !important;
        }

        .btn-loading::after {
            content: '';
            position: absolute;
            width: 1.25rem;
            height: 1.25rem;
            border: 2px solid transparent;
            border-top-color: currentColor;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <!-- Botão Início -->
    <div class="home-button">
        <a href="/" class="btn-home">
            <i class="fas fa-home"></i>
            Início
        </a>
    </div>
    
    <i class="fas fa-sign-in-alt decoration decoration-1"></i>
    <i class="fas fa-key decoration decoration-2"></i>

    <div class="login-container">
        <div class="login-card">
            <div class="card-header">
                <i class="fas fa-chart-line fa-2x"></i> SGE
                <h1 class="card-title">Acessar Sistema</h1>
                <p class="card-subtitle">Entre com suas credenciais para continuar</p>
            </div>
            
            <div class="card-body">
                <!-- Mensagens de erro/sucesso -->
                @if(session('error'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <div class="form-group">
                        <label for="email" class="form-label">E-mail</label>
                        <div class="input-container">
                            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                   placeholder="voce@exemplo.com" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            <i class="fas fa-envelope input-icon"></i>
                        </div>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="password" class="form-label">Senha</label>
                        <div class="input-container">
                            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                                   placeholder="Sua senha" required autocomplete="current-password">
                            <i class="fas fa-lock input-icon"></i>
                        </div>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember">
                            Lembrar-me
                        </label>
                    </div>

                    <div class="submit-container">
                        <button type="submit" class="btn-primary">
                            <i class="fas fa-sign-in-alt"></i>
                            Entrar no sistema
                        </button>
                    </div>
                </form>

                <div class="auth-links">
                    Não tem uma conta? <a href="{{ route('cadastro') }}">Cadastre-se aqui</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//code.jivosite.com/widget/1Qbb3wfMiV" async></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const inputs = form.querySelectorAll('input');
            
            // Validação em tempo real
            inputs.forEach(input => {
                input.addEventListener('blur', function() {
                    validateField(this);
                });
                
                input.addEventListener('input', function() {
                    if (this.classList.contains('is-invalid')) {
                        validateField(this);
                    }
                });
            });
            
            // Função de validação
            function validateField(field) {
                const value = field.value.trim();
                
                if (field.hasAttribute('required') && !value) {
                    field.classList.add('is-invalid');
                    field.classList.remove('is-valid');
                    return false;
                }
                
                if (field.type === 'email' && value) {
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailRegex.test(value)) {
                        field.classList.add('is-invalid');
                        field.classList.remove('is-valid');
                        return false;
                    }
                }
                
                field.classList.remove('is-invalid');
                field.classList.add('is-valid');
                return true;
            }
            
            // Prevenir envio duplo do formulário
            form.addEventListener('submit', function() {
                const submitBtn = form.querySelector('button[type="submit"]');
                submitBtn.disabled = true;
                setTimeout(() => {
                    submitBtn.disabled = false;
                }, 3000);
            });
        });
    </script>
</body>
</html>