FUNÇÃO VIA CEP = https://www.youtube.com/watch?v=imk6Y0viabg&t=1869s
Arquivos que integrei a API = perfil.blade.php, checkout.blade.php

TABELA CLIENTES INTEGRAÇAO SQL = 
Arquivos que integrei a API = AuthController.php, PerfilController.php, perfil.blade.php

NOME E EMAIL (AuthController.php):

try {
    Cliente::create([
        'nome' => $request->name,
        'email' => $request->email
    ]);
} catch (\Exception $e) {
}

CPF (PerfilController.php):

try {
    $cliente = Cliente::where('email', $user['email'])->first();
    
    if ($cliente) {
        $cliente->update([
            'cpf' => $request->cpf
        ]);
    }
} catch (\Exception $e) {
}

CEP, Logradouro, Bairro, Cidade e Uf (PerfilController.php):

