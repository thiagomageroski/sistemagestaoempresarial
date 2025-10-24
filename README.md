FUNÇÃO VIA CEP (perfil.blade.php, checkout.blade.php) = https://www.youtube.com/watch?v=imk6Y0viabg&t=1869s

TABELA CLIENTES INTEGRAÇAO SQL = https://www.youtube.com/watch?v=QYT_Hy0Mx2Q&t=316s, https://www.youtube.com/watch?v=JghBWzm5gRY

## MODEL:

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

## NOME E EMAIL (AuthController.php):

Cliente::create([
    'nome' => $request->name,
    'email' => $request->email
]);

## CPF (PerfilController.php):

$cliente = Cliente::where('email', $user['email'])->first();

if ($cliente) {
    $cliente->update([
        'cpf' => $request->cpf
    ]);
}

## CEP, Logradouro, Bairro, Cidade e Uf (CheckoutController.php):

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

## IMPLEMENTAÇÃO CRIAÇÃO DE PRODUTOS NO /ADMIN (AdminController.php, admin.blade.php, ProdutoController.php, CarrinhoController.php, CheckoutController.php, web.php) = https://www.youtube.com/watch?v=UF3bUQAIXu4, https://www.youtube.com/watch?v=ZQJdYM1m4q0, https://www.youtube.com/shorts/GdZsi9qqSME

FUNÇÕES PRINCIPAIS:

## AdminController.php
## Salva o produto criado no banco de dados:

Produto::create([
    'nome' => $request->nome,
    'descricao' => $request->descricao,
    'preco' => $request->preco,
    'imagem' => $imagemPath
]);

## CheckoutController.php
## Processa/atualiza o Cliente no no método processarPedido()

$cliente->update([...]);

$cliente = Cliente::create([...]);

## AdminController.php
## salvarProduto() metodo principal para criaçao de produtos

public function salvarProduto(Request $request)
{
    $request->validate([
        'nome' => 'required',
        'descricao' => 'required',
        'preco' => 'required|numeric',
        'imagem' => 'required|image'
    ]);

    $imagemPath = $request->file('imagem')->store('products', 'public');

    Produto::create([
        'nome' => $request->nome,
        'descricao' => $request->descricao,
        'preco' => $request->preco,
        'imagem' => $imagemPath
    ]);

    return redirect()->route('produtos.index')->with('success', 'Produto cadastrado!');
}