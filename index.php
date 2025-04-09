<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php

// --- Exemplo de como usar a classe ---

    require_once 'html_class.php'; // Incluir a classe FormBuilder

    $form = new FormBuilder();
    $now = date('Y-m-d H:i:s'); // Example format: 2023-10-27 15:30:00

    // Iniciar o formulário com o método startForm
    echo $form->startForm('/html/processar.php', 'post', ['id' => 'cadastro', 'class' => 'meu-form']);

    // ... (campos nome, email, senha) ...
    echo '<div>';
    echo $form->label('nome', 'Nome de Usuário:'); 
    echo $form->input('text', 'nome', '', ['id' => 'nome', 'placeholder' => 'Digite seu nome', 'required' => true, 'maxlength' => '50', 'class' => 'form-control']);
    echo '</div>';

    echo '<div>';
    echo $form->label('data_nascimento', 'Data de Nascimento:');
    echo $form->dateInput('data_nascimento', '', ['id' => 'data_nascimento', 'required' => true, 'class' => 'form-control']);
    echo '</div>';

    echo '<div>';
    echo $form->label('email', 'Email:', ['class' => 'label-obrigatorio']); // Changed label 'for' and added class for required field
    echo $form->input('email', 'email', '', ['id' => 'email','placeholder' => 'Digite seu email', 'required' => true, 'class' => 'form-control']);
    echo '</div>';

    echo '<div>';
    echo $form->label('senha', 'Password:');
    echo $form->input('password', 'senha', '', ['id' => 'senha','placeholder' => 'Digite sua senha', 'required' => true, 'class' => 'form-control']);
    echo '</div>';

    echo '<div>';
    echo $form->label('senha_confirmacao', 'Confirmar Password:'); // Changed label 'for'
    echo $form->input('password', 'senha_confirmacao', '', ['id' => 'senha_confirmacao','placeholder' => 'Digite novamente sua senha', 'required' => true, 'class' => 'form-control']); 
    echo '</div>';


    echo '<div>';
    echo $form->label('pais', 'País:'); // Add a label for the select
    // Define the options for the select dropdown
    $paises = [
        '' => 'Selecione um país...', // Optional placeholder
        'BR' => 'Brasil',
        'PT' => 'Portugal',
        'US' => 'Estados Unidos',
        'ES' => 'Espanha'
        // Add more countries as needed
    ];
    // Corrected call to the new select method
    // Pass the options array ($paises) as the second argument
    // Pass the attributes as the fourth argument (in an array)
    echo $form->select('pais', $paises, '', ['id' => 'pais', 'required' => true, 'class' => 'form-control']);
    echo '</div>';
   

    echo '<div>';
    echo $form->label('telefone', 'Telefone:'); // Changed label 'for' to match id
    echo $form->input('telefone', 'telefone', '', ['id' => 'telefone','placeholder' => 'Insira telefone', 'required' => true, 'class' => 'form-control']); 
    echo '</div>';

    // ... other fields ... Exemplo com 'form-control' e rows/cols para textarea
    echo '<div>';
    echo $form->label('mensagem', 'Comentário:'); // Changed label 'for' and text
    echo $form->textarea('mensagem', '' , ['id' => 'mensagem', 'placeholder' => 'Digite um comentario', 'class' => 'form-control', 'rows' => 4]); // Changed name and id
    echo '</div>';


    //O input hidden não precisa de class="form-control" nem de um <div> visível ao redor dele, pois ele não é exibido.
    echo '<div>';
    // 1. Get the current date and time in a desired format
    // 2. Use 'current_datetime' (as a string) for the name
    // 3. Pass the $now variable as the value (3rd argument)
    // 4. Pass the array as the $attributes (4th argument)
    // Changed the name or choose a suitable name)
    echo $form->input('hidden', 'data_hora', $now,  ['id' => 'hidden_datetime', 'class' => 'form-control']);
    echo '</div>';

    // --- Rádios ---
    echo '<div>'; 
    echo '<p>Sexo:</p>'; // Mantém o título como block
    // Adiciona a classe 'radio-group' ao div que contém as opções
    echo '<div class="radio-group">';
    // Primeira opção (input + label)
    echo $form->input('radio', 'sexo', 'masculino', ['id' => 'masculino']);
    echo $form->label('masculino', 'Masculino'); // Não precisa mais do espaço inicial
    // Segunda opção (input + label)
    echo $form->input('radio', 'sexo', 'feminino', ['id' => 'feminino']);
    echo $form->label('feminino', 'Feminino');
    echo '</div>'; // Fecha o div.radio-group
    echo '</div>'; // Fecha o div container geral da seção

// --- Checkboxes (Exemplo: se quisesse na mesma linha, usaria a mesma classe 'radio-group') ---
echo '<div>';
echo '<p>Escolha as linguagens de programação:</p>';
echo '<div>';
// Para checkboxes em linhas separadas
// Aplicar display:inline ao label aqui se necessário, ou usar a classe .radio-group se quiser inline
echo '<div>';
echo $form->input('checkbox', 'opcoes[]', 'cpp', ['id' => 'opcao_cpp']); // Valor e ID únicos
echo $form->label('opcao_cpp', ' C++');
echo '</div>';
echo '<div>';
echo $form->input('checkbox', 'opcoes[]', 'php', ['id' => 'opcao_php']);
echo $form->label('opcao_php', ' PHP');
echo '</div>';
echo '<div>';
echo $form->input('checkbox', 'opcoes[]', 'java', ['id' => 'opcao_java']); 
echo $form->label('opcao_java', ' Java');
echo '</div>';
echo '<div>';
echo $form->input('checkbox', 'opcoes[]', 'python', ['id' => 'opcao_python']); 
echo $form->label('opcao_python', ' Python'); 
echo '</div>';

// Botão de envio
echo $form->input('submit', 'enviar', 'Cadastrar', ['class' => 'botao-principal']);
echo $form->endForm();

// --- Campos adicionais ---
/*
echo '<br><br>';
echo $form->label('quantidade', 'Quantidade:');
echo $form->numberInput('quantidade', '1', ['id' => 'quantidade', 'min' => '1', 'max' => '10', 'class' => 'form-control']); // step="any" será adicionado automaticamente

echo $form->label('telefone_contato', 'Telefone:');
echo $form->telInput('telefone_contato', '', ['id' => 'telefone_contato', 'pattern' => '[0-9]{9,15}', 'class' => 'form-control']); // Usará o placeholder padrão se não for definido outro
*/
?>
</body>
</html>

