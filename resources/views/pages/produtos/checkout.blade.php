<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Finalizar Compra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome@6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --primary-light: #c7d2fe;
            --secondary: #10b981;
            --accent: #f59e0b;
            --dark: #1f2937;
            --dark-gray: #4b5563;
            --gray: #9ca3af;
            --light-gray: #e5e7eb;
            --light: #f3f4f6;
            --lighter: #f9fafb;
            --danger: #ef4444;
            --success: #10b981;
            --warning: #f59e0b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            color: var(--dark);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .main-content {
            flex: 1;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header Styles */
        .page-header {
            text-align: center;
            margin: 2rem 0 3rem;
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }

        .page-subtitle {
            color: var(--dark-gray);
            font-size: 1.1rem;
            font-weight: 400;
        }

        /* Progress Steps */
        .progress-container {
            margin: 2rem auto;
            max-width: 800px;
        }

        .progress-steps {
            display: flex;
            justify-content: space-between;
            position: relative;
            margin-bottom: 3rem;
        }

        .progress-steps::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
            height: 3px;
            width: 100%;
            background-color: var(--light-gray);
            z-index: 1;
        }

        .progress-bar {
            position: absolute;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
            height: 3px;
            width: 50%;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            z-index: 2;
            transition: width 0.3s ease;
        }

        .step {
            width: 45px;
            height: 45px;
            background-color: var(--light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            position: relative;
            z-index: 3;
            border: 2px solid var(--light-gray);
            transition: all 0.3s ease;
        }

        .step.active {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            border-color: var(--primary);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        }

        .step-label {
            position: absolute;
            top: 50px;
            left: 50%;
            transform: translateX(-50%);
            white-space: nowrap;
            font-size: 0.85rem;
            color: var(--dark-gray);
            font-weight: 500;
        }

        /* Checkout Layout */
        .checkout-layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2.5rem;
            margin-bottom: 4rem;
            position: relative;
            align-items: start;
        }

        @media (max-width: 968px) {
            .checkout-layout {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .right-column {
                position: static !important;
            }

            .sticky-sidebar {
                position: static !important;
            }
        }

        /* Form Styles */
        .form-section {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
            border: 1px solid var(--light-gray);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .form-section:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        .section-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--light);
            display: flex;
            align-items: center;
            color: var(--dark);
        }

        .section-title i {
            margin-right: 12px;
            color: var(--primary);
            font-size: 1.2em;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.6rem;
            font-weight: 500;
            font-size: 0.95rem;
            color: var(--dark);
        }

        .form-control {
            width: 100%;
            padding: 1rem 1.2rem;
            border: 2px solid var(--light-gray);
            border-radius: 12px;
            font-family: 'Inter', sans-serif;
            font-size: 1rem;
            transition: all 0.3s ease;
            background-color: var(--lighter);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
            background-color: white;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.2rem;
        }

        @media (max-width: 576px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }

        /* Sticky Sidebar - Contém Resumo, Cupom e Frete */
        .right-column {
            position: relative;
        }

        .sticky-sidebar {
            position: sticky;
            top: 2rem;
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .order-summary {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid var(--light-gray);
        }

        .summary-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--light);
            color: var(--dark);
        }

        .cart-items {
            margin-bottom: 2rem;
            max-height: 300px;
            overflow-y: auto;
            padding-right: 0.5rem;
        }

        .cart-items::-webkit-scrollbar {
            width: 6px;
        }

        .cart-items::-webkit-scrollbar-track {
            background: var(--light);
            border-radius: 3px;
        }

        .cart-items::-webkit-scrollbar-thumb {
            background: var(--gray);
            border-radius: 3px;
        }

        .cart-items::-webkit-scrollbar-thumb:hover {
            background: var(--dark-gray);
        }

        .cart-item {
            display: flex;
            margin-bottom: 1.2rem;
            padding-bottom: 1.2rem;
            border-bottom: 1px solid var(--light-gray);
            align-items: center;
        }

        .item-image {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            overflow: hidden;
            margin-right: 1.2rem;
            flex-shrink: 0;
            border: 2px solid var(--light);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .cart-item:hover .item-image img {
            transform: scale(1.05);
        }

        .item-details {
            flex: 1;
        }

        .item-name {
            font-weight: 600;
            margin-bottom: 0.4rem;
            font-size: 0.95rem;
            color: var(--dark);
            line-height: 1.4;
        }

        .item-price {
            color: var(--primary);
            font-weight: 700;
            font-size: 1rem;
            margin-bottom: 0.3rem;
        }

        .item-quantity {
            color: var(--dark-gray);
            font-size: 0.85rem;
            font-weight: 500;
        }

        .summary-line {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.8rem;
            font-size: 1rem;
            color: var(--dark);
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            font-weight: 700;
            font-size: 1.3rem;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 3px solid var(--light);
            color: var(--dark);
        }

        .total-value {
            color: var(--primary);
        }

        /* Payment Methods */
        .payment-methods {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin-top: 1.5rem;
        }

        @media (max-width: 576px) {
            .payment-methods {
                grid-template-columns: 1fr;
            }
        }

        .payment-method {
            border: 2px solid var(--light-gray);
            border-radius: 12px;
            padding: 1.2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white;
            min-height: 110px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .payment-method:hover {
            border-color: var(--primary);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .payment-method.selected {
            border-color: var(--primary);
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.15);
        }

        .payment-method i {
            font-size: 2.2rem;
            margin-bottom: 0.8rem;
            color: var(--dark);
            transition: color 0.3s ease;
        }

        .payment-method.selected i {
            color: var(--primary);
        }

        .payment-method p {
            font-weight: 600;
            color: var(--dark);
            margin: 0;
            font-size: 0.95rem;
        }

        /* Credit Card Form */
        .credit-card-form {
            margin-top: 1.5rem;
            padding: 1.5rem;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-radius: 12px;
            border: 2px solid var(--light-gray);
            transition: all 0.3s ease;
            display: none;
        }

        .credit-card-form:hover {
            border-color: var(--primary-light);
        }

        /* Payment Info Messages */
        .payment-info {
            margin-top: 1.5rem;
            padding: 1.5rem;
            background: linear-gradient(135deg, #fef3c7 0%, #fef3c7 100%);
            border-radius: 12px;
            border: 2px solid #fcd34d;
            text-align: center;
            display: none;
        }

        .payment-info.pix {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            border-color: #34d399;
            text-align: left;
            display: none;
        }

        .payment-info i {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: #f59e0b;
        }

        .payment-info.pix i {
            color: #10b981;
        }

        .payment-info h4 {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
            color: #92400e;
        }

        .payment-info.pix h4 {
            color: #065f46;
        }

        .payment-info p {
            color: #92400e;
            margin-bottom: 0;
        }

        .payment-info.pix p {
            color: #065f46;
        }

        /* Buttons - Estilo Suave e Elegante */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 1.1rem 2.2rem;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white !important;
            border: none;
            border-radius: 14px;
            font-family: 'Inter', sans-serif;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            text-align: center;
            gap: 0.6rem;
            box-shadow: 0 6px 16px rgba(99, 102, 241, 0.25);
            text-decoration: none;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.7s ease;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(99, 102, 241, 0.4);
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
            color: white;
        }

        .btn:active {
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(99, 102, 241, 0.4);
        }

        .btn-block {
            display: flex;
            width: 100%;
            justify-content: center;
            margin-top: 1rem;
        }

        .btn-sm {
            padding: 0.8rem 1.5rem;
            font-size: 0.95rem;
            border-radius: 12px;
        }

        .btn-back {
            background: linear-gradient(135deg, #f8fafc 0%, #e5e7eb 100%) !important;
            color: var(--dark) !important;
            border: 2px solid var(--light-gray);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .btn-back:hover {
            background: linear-gradient(135deg, #e5e7eb 0%, #d1d5db 100%) !important;
            border-color: var(--gray);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            color: var(--dark) !important;
        }

        /* Botão Azul para Calcular Frete */
        .btn-accent {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%) !important;
            box-shadow: 0 6px 16px rgba(99, 102, 241, 0.25);
        }

        .btn-accent:hover {
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%) !important;
            box-shadow: 0 10px 25px rgba(99, 102, 241, 0.4);
        }

        .btn-success {
            background: linear-gradient(135deg, var(--success) 0%, #0d966c 100%) !important;
            box-shadow: 0 6px 16px rgba(16, 185, 129, 0.25);
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #0d966c 0%, var(--success) 100%) !important;
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.4);
        }

        .btn-danger {
            background: linear-gradient(135deg, var(--danger) 0%, #dc2626 100%) !important;
            box-shadow: 0 6px 16px rgba(239, 68, 68, 0.25);
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #dc2626 0%, var(--danger) 100%) !important;
            box-shadow: 0 10px 25px rgba(239, 68, 68, 0.4);
        }

        .action-buttons {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 1.2rem;
            margin-top: 2rem;
        }

        @media (max-width: 576px) {
            .action-buttons {
                grid-template-columns: 1fr;
            }
        }

        /* Cupom Section */
        .cupom-section {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            border: 2px dashed #7dd3fc;
            border-radius: 14px;
            padding: 1.5rem;
            margin-top: 1.2rem;
        }

        .cupom-form {
            display: flex;
            gap: 0.8rem;
        }

        .cupom-input {
            flex: 1;
        }

        .cupom-applied {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            border: 2px solid #34d399;
            border-radius: 14px;
            padding: 1.5rem;
            margin-top: 1.2rem;
            display: none;
        }

        .cupom-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .cupom-code {
            font-weight: 600;
            color: var(--success);
            font-size: 1.1rem;
        }

        /* Toast Notification */
        .toast {
            position: fixed;
            top: 25px;
            right: 25px;
            background: white;
            padding: 1.2rem 1.8rem;
            border-radius: 14px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            gap: 0.8rem;
            z-index: 10000;
            border-left: 4px solid var(--success);
            transform: translateX(100%);
            transition: transform 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            max-width: 350px;
        }

        .toast.show {
            transform: translateX(0);
        }

        .toast.error {
            border-left-color: var(--danger);
        }

        .toast.warning {
            border-left-color: var(--warning);
        }

        .toast i {
            font-size: 1.4rem;
        }

        .toast.success i {
            color: var(--success);
        }

        .toast.error i {
            color: var(--danger);
        }

        .toast.warning i {
            color: var(--warning);
        }

        /* Loading Overlay */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.95);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .loading-overlay.show {
            opacity: 1;
            visibility: visible;
            backdrop-filter: blur(5px);
        }

        .spinner {
            width: 60px;
            height: 60px;
            border: 4px solid var(--light);
            border-top: 4px solid var(--primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Empty State */
        .empty-cart {
            text-align: center;
            padding: 4rem 2rem;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            max-width: 500px;
            margin: 2rem auto;
            border: 1px solid var(--light-gray);
        }

        .empty-icon {
            font-size: 5rem;
            color: var(--light-gray);
            margin-bottom: 1.5rem;
            opacity: 0.7;
        }

        .empty-cart h3 {
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 1rem;
            text-align: center;
        }

        .empty-cart p {
            color: var(--dark-gray);
            margin-bottom: 2rem;
            font-size: 1.1rem;
            text-align: center;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .page-title {
                font-size: 2rem;
            }

            .page-subtitle {
                font-size: 1rem;
            }

            .form-section,
            .order-summary {
                padding: 1.5rem;
            }

            .section-title {
                font-size: 1.2rem;
            }

            .btn {
                padding: 1rem 1.8rem;
                font-size: 1.05rem;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 0 15px;
            }

            .form-section,
            .order-summary {
                padding: 1.2rem;
                border-radius: 12px;
            }

            .page-title {
                font-size: 1.8rem;
            }

            .btn {
                padding: 0.9rem 1.5rem;
                font-size: 1rem;
            }

            .cupom-form {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="spinner"></div>
    </div>

    <!-- Header -->
    @include('partials.navbar')

    <!-- Main Content -->
    <main class="main-content">
        <div class="container py-5">
            <div class="progress-container">
                <div class="progress-steps">
                    <div class="progress-bar"></div>
                    <div class="step active">
                        1
                        <span class="step-label">Carrinho</span>
                    </div>
                    <div class="step active">
                        2
                        <span class="step-label">Checkout</span>
                    </div>
                    <div class="step">
                        3
                        <span class="step-label">Confirmação</span>
                    </div>
                </div>
            </div>

            <div class="page-header">
                <h1 class="page-title">Finalizar Compra</h1>
                <p class="page-subtitle">Complete suas informações para finalizar o pedido</p>
            </div>

            @if(count($carrinho) > 0)
                <div class="checkout-layout">
                    <!-- Left Column - Form -->
                    <div class="left-column">
                        <!-- Contact Information -->
                        <div class="form-section">
                            <h2 class="section-title">
                                <i class="fas fa-user"></i>
                                Informações de Contato
                            </h2>
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input type="email" id="email" class="form-control" placeholder="Seu e-mail"
                                    value="{{ $user['email'] ?? '' }}" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Telefone</label>
                                <input type="tel" id="phone" class="form-control" placeholder="(11) 99999-9999" required>
                            </div>
                        </div>

                        <!-- Shipping Address -->
                        <div class="form-section">
                            <h2 class="section-title">
                                <i class="fas fa-truck"></i>
                                Endereço de Entrega
                            </h2>
                            <div class="form-group">
                                <label for="fullname">Nome Completo</label>
                                <input type="text" id="fullname" class="form-control" placeholder="Seu nome completo"
                                    value="{{ $user['name'] ?? '' }}" required>
                            </div>
                            <div class="form-group">
                                <label for="zipcode">CEP</label>
                                <input type="text" id="zipcode" class="form-control" placeholder="00000-000" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Endereço</label>
                                <input type="text" id="address" class="form-control" placeholder="Rua, número e complemento"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="neighborhood">Bairro</label>
                                <input type="text" id="neighborhood" class="form-control" placeholder="Seu bairro" required>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="city">Cidade</label>
                                    <input type="text" id="city" class="form-control" placeholder="Sua cidade" required>
                                </div>
                                <div class="form-group">
                                    <label for="state">Estado</label>
                                    <select id="state" class="form-control" required>
                                        <option value="">Selecione o estado</option>
                                        <option value="AC">Acre</option>
                                        <option value="AL">Alagoas</option>
                                        <option value="AP">Amapá</option>
                                        <option value="AM">Amazonas</option>
                                        <option value="BA">Bahia</option>
                                        <option value="CE">Ceará</option>
                                        <option value="DF">Distrito Federal</option>
                                        <option value="ES">Espírito Santo</option>
                                        <option value="GO">Goiás</option>
                                        <option value="MA">Maranhão</option>
                                        <option value="MT">Mato Grosso</option>
                                        <option value="MS">Mato Grosso do Sul</option>
                                        <option value="MG">Minas Gerais</option>
                                        <option value="PA">Pará</option>
                                        <option value="PB">Paraíba</option>
                                        <option value="PR">Paraná</option>
                                        <option value="PE">Pernambuco</option>
                                        <option value="PI">Piauí</option>
                                        <option value="RJ">Rio de Janeiro</option>
                                        <option value="RN">Rio Grande do Norte</option>
                                        <option value="RS">Rio Grande do Sul</option>
                                        <option value="RO">Rondônia</option>
                                        <option value="RR">Roraima</option>
                                        <option value="SC">Santa Catarina</option>
                                        <option value="SP">São Paulo</option>
                                        <option value="SE">Sergipe</option>
                                        <option value="TO">Tocantins</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div class="form-section" id="payment-section">
                            <h2 class="section-title">
                                <i class="fas fa-credit-card"></i>
                                Método de Pagamento
                            </h2>
                            <div class="payment-methods">
                                <div class="payment-method selected" data-method="cartao">
                                    <i class="fas fa-credit-card"></i>
                                    <p>Cartão de Crédito</p>
                                </div>
                                <div class="payment-method" data-method="pix">
                                    <i class="fas fa-qrcode"></i>
                                    <p>PIX</p>
                                </div>
                            </div>

                            <!-- Credit Card Form -->
                            <div class="credit-card-form" id="creditCardForm">
                                <div class="form-group">
                                    <label for="card-number">Número do Cartão</label>
                                    <input type="text" id="card-number" class="form-control"
                                        placeholder="0000 0000 0000 0000" required>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="card-name">Nome no Cartão</label>
                                        <input type="text" id="card-name" class="form-control" placeholder="Como no cartão"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="card-expiry">Validade</label>
                                        <input type="text" id="card-expiry" class="form-control" placeholder="MM/AA"
                                            required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="card-cvv">CVV</label>
                                        <input type="text" id="card-cvv" class="form-control" placeholder="000" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="card-installments">Parcelas</label>
                                        <select id="card-installments" class="form-control" required>
                                            <option value="1">1x de R$ {{ number_format($total, 2, ',', '.') }} sem juros
                                            </option>
                                            <option value="2">2x de R$ {{ number_format($total / 2, 2, ',', '.') }} sem
                                                juros</option>
                                            <option value="3">3x de R$ {{ number_format($total / 3, 2, ',', '.') }} sem
                                                juros</option>
                                            <option value="4">4x de R$ {{ number_format($total / 4, 2, ',', '.') }} sem
                                                juros</option>
                                            <option value="5">5x de R$ {{ number_format($total / 5, 2, ',', '.') }} sem
                                                juros</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Boleto Message -->
                            <div class="payment-info" id="boletoInfo">
                                <i class="fas fa-exclamation-circle"></i>
                                <h4>Indisponível no momento</h4>
                                <p>O pagamento por boleto bancário não está disponível no momento. Por favor, escolha outra
                                    forma de pagamento.</p>
                            </div>

                            <!-- Transferência Message -->
                            <div class="payment-info" id="transferenciaInfo">
                                <i class="fas fa-exclamation-circle"></i>
                                <h4>Indisponível no momento</h4>
                                <p>O pagamento por transferência bancária não está disponível no momento. Por favor, escolha
                                    outra forma de pagamento.</p>
                            </div>

                            <!-- PIX Form -->
                            <div class="payment-info pix" id="pixInfo">
                                <i class="fas fa-qrcode"></i>
                                <h4>Pagamento via PIX</h4>
                                <p>Para finalizar o pagamento via PIX, preencha os dados abaixo:</p>
                                <div class="form-group mt-3">
                                    <label for="pix-cpf">CPF</label>
                                    <input type="text" id="pix-cpf" class="form-control" placeholder="000.000.000-00"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="pix-name">Nome Completo</label>
                                    <input type="text" id="pix-name" class="form-control"
                                        placeholder="Seu nome completo como no CPF" required>
                                </div>
                            </div>
                        </div>

                        <!-- Formulário de Checkout -->
                        <form action="{{ route('checkout.processar') }}" method="POST" id="checkoutForm">
                            @csrf
                            <input type="hidden" name="metodo_pagamento" id="metodoPagamento" value="cartao">
                            <input type="hidden" name="numero_cartao" id="numeroCartaoInput">
                            <input type="hidden" name="nome_cartao" id="nomeCartaoInput">
                            <input type="hidden" name="validade_cartao" id="validadeCartaoInput">
                            <input type="hidden" name="cvv_cartao" id="cvvCartaoInput">
                            <input type="hidden" name="pix_cpf" id="pixCpfInput">
                            <input type="hidden" name="pix_nome" id="pixNomeInput">

                            <!-- Campos ocultos para dados do formulário -->
                            <input type="hidden" name="email" id="emailInput">
                            <input type="hidden" name="telefone" id="telefoneInput">
                            <input type="hidden" name="nome_completo" id="nomeCompletoInput">
                            <input type="hidden" name="endereco" id="enderecoInput">
                            <input type="hidden" name="cidade" id="cidadeInput">
                            <input type="hidden" name="estado" id="estadoInput">
                            <input type="hidden" name="cep" id="cepInput">
                            <input type="hidden" name="bairro" id="bairroInput">

                            <div class="action-buttons">
                                <a href="{{ route('carrinho.index') }}" class="btn btn-back">
                                    <i class="fas fa-arrow-left"></i>
                                    Voltar ao Carrinho
                                </a>
                                <button type="submit" class="btn" id="submitButton">
                                    <i class="fas fa-lock"></i>
                                    Finalizar Pedido
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Right Column - Order Summary, Cupom e Frete FIXOS -->
                    <div class="right-column">
                        <div class="sticky-sidebar">
                            <!-- Resumo do Pedido -->
                            <div class="order-summary">
                                <h2 class="summary-title">Resumo do Pedido</h2>

                                <div class="cart-items">
                                    @foreach($carrinho as $item)
                                        <div class="cart-item">
                                            <div class="item-image">
                                                <img src="{{ asset('storage/' . $item['imagem']) }}" alt="{{ $item['nome'] }}">
                                            </div>
                                            <div class="item-details">
                                                <div class="item-name">{{ $item['nome'] }}</div>
                                                <div class="item-price">R$ {{ number_format($item['preco'], 2, ',', '.') }}
                                                </div>
                                                <div class="item-quantity">Quantidade: {{ $item['quantidade'] }}</div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="summary-line">
                                    <span>Subtotal</span>
                                    <span>R$ {{ number_format($subtotal, 2, ',', '.') }}</span>
                                </div>
                                <div class="summary-line">
                                    <span>Frete</span>
                                    <span id="freteValue">R$ {{ number_format($frete, 2, ',', '.') }}</span>
                                </div>
                                @if($desconto > 0)
                                    <div class="summary-line">
                                        <span>Desconto</span>
                                        <span style="color: var(--success);" id="descontoValue">-R$
                                            {{ number_format($desconto, 2, ',', '.') }}</span>
                                    </div>
                                @endif

                                <div class="summary-total">
                                    <span>Total</span>
                                    <span class="total-value" id="totalValue">R$
                                        {{ number_format($total, 2, ',', '.') }}</span>
                                </div>
                            </div>

                            <!-- Cupom de Desconto - CORRIGIDO -->
                            <div class="form-section">
                                <h2 class="section-title">
                                    <i class="fas fa-ticket-alt"></i>
                                    Cupom de Desconto
                                </h2>

                                <!-- Formulário para aplicar cupom - SEMPRE VISÍVEL -->
                                <div class="cupom-section" id="cupomFormSection">
                                    <div class="cupom-form">
                                        <input type="text" class="form-control cupom-input" id="cupomInput"
                                            placeholder="Digite o código do cupom">
                                        <button type="button" class="btn btn-success" id="aplicarCupomBtn">
                                            <i class="fas fa-check"></i>
                                            Aplicar
                                        </button>
                                    </div>
                                </div>

                                <!-- Seção de cupom aplicado - APENAS QUANDO HÁ CUPOM -->
                                @if($desconto > 0 && $cupomAplicado)
                                    <div class="cupom-applied" id="cupomAppliedSection">
                                        <div class="cupom-info">
                                            <div>
                                                <span class="cupom-code" id="cupomCodigoAplicado">{{ $cupomAplicado }}</span>
                                                <span style="color: var(--success); font-weight: 600;">
                                                    -R$ {{ number_format($desconto, 2, ',', '.') }}
                                                </span>
                                            </div>
                                            <button type="button" class="btn btn-danger btn-sm" id="removerCupomBtn">
                                                <i class="fas fa-times"></i>
                                                Remover
                                            </button>
                                        </div>
                                        <div style="font-size: 0.9rem; color: var(--dark-gray);">
                                            Cupom aplicado com sucesso! Desconto já incluído no total.
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Calcular Frete -->
                            <div class="form-section">
                                <h2 class="section-title">
                                    <i class="fas fa-truck"></i>
                                    Calcular Frete
                                </h2>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="cepFreteInput" placeholder="Digite seu CEP">
                                </div>
                                <button type="button" class="btn btn-accent btn-block" id="calcularFreteBtn">
                                    <i class="fas fa-calculator"></i>
                                    Calcular Frete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="empty-cart">
                    <div class="empty-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <h3>Seu carrinho está vazio</h3>
                    <p>Adicione produtos ao carrinho antes de finalizar a compra</p>
                    <a href="{{ route('produtos.index') }}" class="btn">
                        <i class="fas fa-shopping-bag"></i>
                        Continuar Comprando
                    </a>
                </div>
            @endif
        </div>
    </main>

    <!-- Footer -->
    @include('partials.footer')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Elementos da interface
            const loadingOverlay = document.getElementById('loadingOverlay');
            const checkoutForm = document.getElementById('checkoutForm');
            const metodoPagamentoInput = document.getElementById('metodoPagamento');
            const creditCardForm = document.getElementById('creditCardForm');
            const paymentMethods = document.querySelectorAll('.payment-method');
            const aplicarCupomBtn = document.getElementById('aplicarCupomBtn');
            const removerCupomBtn = document.getElementById('removerCupomBtn');
            const calcularFreteBtn = document.getElementById('calcularFreteBtn');
            const cupomInput = document.getElementById('cupomInput');
            const cepFreteInput = document.getElementById('cepFreteInput');
            const paymentSection = document.getElementById('payment-section');
            const cupomFormSection = document.getElementById('cupomFormSection');
            const cupomAppliedSection = document.getElementById('cupomAppliedSection');
            const boletoInfo = document.getElementById('boletoInfo');
            const transferenciaInfo = document.getElementById('transferenciaInfo');
            const pixInfo = document.getElementById('pixInfo');
            // pegar elementos html pelo id VICACEP
            const zipcodeInput = document.getElementById('zipcode');
            const addressInput = document.getElementById('address');
            const neighborhoodInput = document.getElementById('neighborhood');
            const cityInput = document.getElementById('city');
            const stateInput = document.getElementById('state');

            // funçao busca cep
            function buscarCEP(cep) {
                cep = cep.replace(/\D/g, '');

                if (cep.length !== 8) return;

                // resposta ao json
                fetch(`https://viacep.com.br/ws/${cep}/json/`)
                    .then(response => response.json())
                    .then(data => {
                        if (!data.erro) {
                            addressInput.value = data.logradouro || '';
                            neighborhoodInput.value = data.bairro || '';
                            cityInput.value = data.localidade || '';
                            stateInput.value = data.uf || '';
                        } else {  // verifica se o cep é valido e mostra mensagem
                            mostrarToast('CEP não encontrado', 'error');
                        }
                    })
            }
            // preencher automatico ao sair do campo CEP
            zipcodeInput.addEventListener('blur', function () {
                buscarCEP(this.value);
            });

            // FIM DO VIACEP

            function ajustarAlturaSecaoPagamento() {
                const alturaInicial = paymentSection.offsetHeight;
                paymentSection.style.minHeight = `${alturaInicial}px`;
            }

            aplicarMascaras();

            paymentMethods.forEach(method => {
                method.addEventListener('click', () => {
                    paymentMethods.forEach(m => m.classList.remove('selected'));
                    method.classList.add('selected');

                    const metodo = method.getAttribute('data-method');
                    metodoPagamentoInput.value = metodo;

                    if (metodo === 'cartao') {
                        creditCardForm.style.display = 'block';
                        boletoInfo.style.display = 'none';
                        transferenciaInfo.style.display = 'none';
                        pixInfo.style.display = 'none';
                    } else if (metodo === 'boleto') {
                        creditCardForm.style.display = 'none';
                        boletoInfo.style.display = 'block';
                        transferenciaInfo.style.display = 'none';
                        pixInfo.style.display = 'none';
                    } else if (metodo === 'transferencia') {
                        creditCardForm.style.display = 'none';
                        boletoInfo.style.display = 'none';
                        transferenciaInfo.style.display = 'block';
                        pixInfo.style.display = 'none';
                    } else if (metodo === 'pix') {
                        creditCardForm.style.display = 'none';
                        boletoInfo.style.display = 'none';
                        transferenciaInfo.style.display = 'none';
                        pixInfo.style.display = 'block';
                    }
                });
            });

            // Mostrar formulário de cartão por padrão (já que é o método selecionado inicialmente)
            creditCardForm.style.display = 'block';

            // Ajustar altura inicial
            ajustarAlturaSecaoPagamento();

            // Aplicar cupom de desconto
            aplicarCupomBtn.addEventListener('click', aplicarCupom);

            // Remover cupom de desconto - SOMENTE SE O BOTÃO EXISTIR
            if (removerCupomBtn) {
                removerCupomBtn.addEventListener('click', removerCupom);
            }

            // Calcular frete
            calcularFreteBtn.addEventListener('click', calcularFrete);

            // Validação do formulário
            checkoutForm.addEventListener('submit', function (e) {
                // Validar o formulário antes de enviar
                if (!validarFormulario()) {
                    e.preventDefault();
                    mostrarToast('Por favor, preencha todos os campos obrigatórios.', 'error');
                    return;
                }

                // Preencher campos ocultos
                document.getElementById('emailInput').value = document.getElementById('email').value;
                document.getElementById('telefoneInput').value = document.getElementById('phone').value;
                document.getElementById('nomeCompletoInput').value = document.getElementById('fullname').value;
                document.getElementById('enderecoInput').value = document.getElementById('address').value;
                document.getElementById('cidadeInput').value = document.getElementById('city').value;
                document.getElementById('estadoInput').value = document.getElementById('state').value;
                document.getElementById('cepInput').value = document.getElementById('zipcode').value;
                document.getElementById('bairroInput').value = document.getElementById('neighborhood').value;

                // Preparar dados conforme o método de pagamento
                if (metodoPagamentoInput.value === 'cartao') {
                    document.getElementById('numeroCartaoInput').value = document.getElementById('card-number').value;
                    document.getElementById('nomeCartaoInput').value = document.getElementById('card-name').value;
                    document.getElementById('validadeCartaoInput').value = document.getElementById('card-expiry').value;
                    document.getElementById('cvvCartaoInput').value = document.getElementById('card-cvv').value;
                } else if (metodoPagamentoInput.value === 'pix') {
                    document.getElementById('pixCpfInput').value = document.getElementById('pix-cpf').value;
                    document.getElementById('pixNomeInput').value = document.getElementById('pix-name').value;
                }

                // Mostrar loading
                showLoading();
            });

            // Funções
            function aplicarMascaras() {
                // Máscara para telefone
                const phoneInput = document.getElementById('phone');
                if (phoneInput) {
                    phoneInput.addEventListener('input', function (e) {
                        let value = e.target.value.replace(/\D/g, '');
                        if (value.length > 11) value = value.slice(0, 11);

                        if (value.length <= 10) {
                            value = value.replace(/(\d{2})(\d{4})(\d{4})/, '($1) $2-$3');
                        } else {
                            value = value.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
                        }

                        e.target.value = value;
                    });
                }

                // Máscara para CEP
                const zipcodeInput = document.getElementById('zipcode');
                const cepFrete = document.getElementById('cepFreteInput');

                [zipcodeInput, cepFrete].forEach(input => {
                    if (input) {
                        input.addEventListener('input', function (e) {
                            let value = e.target.value.replace(/\D/g, '');
                            if (value.length > 8) value = value.slice(0, 8);
                            value = value.replace(/(\d{5})(\d{3})/, '$1-$2');
                            e.target.value = value;
                        });
                    }
                });

                // Máscara para cartão de crédito
                const cardNumberInput = document.getElementById('card-number');
                if (cardNumberInput) {
                    cardNumberInput.addEventListener('input', function (e) {
                        let value = e.target.value.replace(/\D/g, '');
                        if (value.length > 16) value = value.slice(0, 16);
                        value = value.replace(/(\d{4})(?=\d)/g, '$1 ');
                        e.target.value = value;
                    });
                }

                // Máscara para validade
                const cardExpiryInput = document.getElementById('card-expiry');
                if (cardExpiryInput) {
                    cardExpiryInput.addEventListener('input', function (e) {
                        let value = e.target.value.replace(/\D/g, '');
                        if (value.length > 4) value = value.slice(0, 4);
                        value = value.replace(/(\d{2})(\d{2})/, '$1/$2');
                        e.target.value = value;
                    });
                }

                // Máscara para CVV
                const cardCvvInput = document.getElementById('card-cvv');
                if (cardCvvInput) {
                    cardCvvInput.addEventListener('input', function (e) {
                        let value = e.target.value.replace(/\D/g, '');
                        if (value.length > 3) value = value.slice(0, 3);
                        e.target.value = value;
                    });
                }

                // Máscara para CPF do PIX
                const pixCpfInput = document.getElementById('pix-cpf');
                if (pixCpfInput) {
                    pixCpfInput.addEventListener('input', function (e) {
                        let value = e.target.value.replace(/\D/g, '');
                        if (value.length > 11) value = value.slice(0, 11);
                        value = value.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
                        e.target.value = value;
                    });
                }
            }

            function aplicarCupom() {
                const codigo = cupomInput.value.trim();
                if (!codigo) {
                    mostrarToast('Digite um código de cupom.', 'error');
                    return;
                }

                showLoading();

                fetch('{{ route("checkout.aplicar-cupom") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ codigo_cupom: codigo })
                })
                    .then(response => response.json())
                    .then(data => {
                        hideLoading();
                        if (data.success) {
                            mostrarToast(data.message, 'success');
                            // Recarregar a página para atualizar os valores
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);
                        } else {
                            mostrarToast(data.message, 'error');
                        }
                    })
                    .catch(error => {
                        hideLoading();
                        mostrarToast('Erro ao aplicar cupom.', 'error');
                    });
            }

            function removerCupom() {
                showLoading();

                fetch('{{ route("checkout.remover-cupom") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        hideLoading();
                        if (data.success) {
                            mostrarToast(data.message, 'success');
                            // Recarregar a página para atualizar os valores
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);
                        } else {
                            mostrarToast(data.message, 'error');
                        }
                    })
                    .catch(error => {
                        hideLoading();
                        mostrarToast('Erro ao remover cupom.', 'error');
                    });
            }

            function calcularFrete() {
                const cep = cepFreteInput.value.replace(/\D/g, '');
                if (cep.length !== 8) {
                    mostrarToast('Digite um CEP válido.', 'error');
                    return;
                }

                showLoading();

                fetch('{{ route("checkout.calcular-frete") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ cep: cep })
                })
                    .then(response => response.json())
                    .then(data => {
                        hideLoading();
                        if (data.success) {
                            mostrarToast(data.message, 'success');
                            // Atualizar valores na interface
                            document.getElementById('freteValue').textContent = 'R$ ' + data.frete;
                            document.getElementById('totalValue').textContent = 'R$ ' + data.total;
                        } else {
                            mostrarToast(data.message, 'error');
                        }
                    })
                    .catch(error => {
                        hideLoading();
                        mostrarToast('Erro ao calcular frete.', 'error');
                    });
            }

            function validarFormulario() {
                const email = document.getElementById('email').value;
                const phone = document.getElementById('phone').value;
                const fullname = document.getElementById('fullname').value;
                const address = document.getElementById('address').value;
                const city = document.getElementById('city').value;
                const state = document.getElementById('state').value;
                const zipcode = document.getElementById('zipcode').value;
                const neighborhood = document.getElementById('neighborhood').value;

                if (!email || !phone || !fullname || !address || !city || !state || !zipcode || !neighborhood) {
                    return false;
                }

                // Validação específica para cartão de crédito
                if (metodoPagamentoInput.value === 'cartao') {
                    const cardNumber = document.getElementById('card-number').value;
                    const cardName = document.getElementById('card-name').value;
                    const cardExpiry = document.getElementById('card-expiry').value;
                    const cardCvv = document.getElementById('card-cvv').value;

                    if (!cardNumber || !cardName || !cardExpiry || !cardCvv) {
                        return false;
                    }
                }

                // Validação específica para PIX
                if (metodoPagamentoInput.value === 'pix') {
                    const pixCpf = document.getElementById('pix-cpf').value;
                    const pixName = document.getElementById('pix-name').value;

                    if (!pixCpf || !pixName) {
                        return false;
                    }
                }

                return true;
            }

            function mostrarToast(mensagem, tipo = 'success') {
                const toast = document.createElement('div');
                toast.className = `toast ${tipo}`;
                toast.innerHTML = `
                <i class="fas ${tipo === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i>
                <span>${mensagem}</span>
            `;

                document.body.appendChild(toast);
                setTimeout(() => toast.classList.add('show'), 100);

                setTimeout(() => {
                    toast.classList.remove('show');
                    setTimeout(() => toast.remove(), 300);
                }, 3000);
            }

            function showLoading() {
                loadingOverlay.classList.add('show');
            }

            function hideLoading() {
                loadingOverlay.classList.remove('show');
            }
        });
    </script>
</body>

</html>