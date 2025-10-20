FUNÇÃO VIA CEP (perfil.blade.php, checkout.blade.php) = https://www.youtube.com/watch?v=imk6Y0viabg&t=1869s

TABELA CLIENTES INTEGRAÇAO SQL = https://www.youtube.com/watch?v=QYT_Hy0Mx2Q&t=316s, https://www.youtube.com/watch?v=JghBWzm5gRY

MODEL:

protected $fillable = [
        'nome',
        'cpf', 
        'email',
        'cep',
        'logradouro',
        'bairro',
        'cidade',
        'uf'
    ];

NOME E EMAIL (AuthController.php):

Cliente::create([
    'nome' => $request->name,
    'email' => $request->email
]);

CPF (PerfilController.php):

$cliente = Cliente::where('email', $user['email'])->first();

if ($cliente) {
    $cliente->update([
        'cpf' => $request->cpf
    ]);
}

CEP, Logradouro, Bairro, Cidade e Uf (CheckoutController.php):

$cliente = Cliente::where('email', $user['email'])->first();

if ($cliente) {
    $cliente->update([
        'cep' => $request->cep,
        'logradouro' => $request->endereco,
        'bairro' => $request->bairro,
        'cidade' => $request->cidade,
        'uf' => $request->estado
    ]);
}
