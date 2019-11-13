@extends('admin.layouts.app')
@section("content")
<div class="col-md-10">


<form method="post">
  @csrf
 <div class="form-row">
   <div class="col-md-2 mb-3">
     <label for="validationServer01">Situação:</label>
     <select class="custom-select" name="active">
              <option selected disabled>Selecione...</option>
 <option value="1" selected>Ativado</option>
 <option value="0">Desativado</option>
</select>
   </div>

   </div>

 <div class="form-row" id="sex">
   <div class="col-md-6 mb-3">
     <label for="validationServer03">Nome:</label>
     <input type="text" name="name" class="form-control" id="validationServer03" value="{{$product->name}}" placeholder="Nome do produto">

   </div>

 </div>


 <div class="form-row">
   <div class="col-md-3 mb-3">
     <label for="validationServer03">Codigo do Produto</label>
     <input type="text" class="form-control" name="sku" required id="validationServer03" value="{{$product->sku}}"  placeholder="SKU">
   </div>
   <div class="col-md-3 mb-3">
     <label for="validationServer03">GTIN</label>
     <input type="text" class="form-control" name="gtin" required id="validationServer03" value="{{$product->gtin}}" placeholder="GTIN" maxlength="14">
   </div>
   <div class="col-md-3 mb-3">
     <label for="validationServer03">NCM</label>
     <input type="text" class="form-control" name="ncm" required id="validationServer03" value="{{$product->ncm}}" placeholder="NCM" maxlength="8">
   </div>
</div>


<div class="form-row">
   <div class="col-md-3 mb-3">
     <label for="validationServer03">Preço de Custo (R$)</label>
     <input type="text" class="form-control" id="validationServer03" required name="real_price" value="{{number_format($product->real_price, 2)}}" placeholder="0.00">
   </div>
   <div class="col-md-3 mb-3">
     <label for="validationServer03">Preço de Venda (R$)</label>
     <input type="text" class="form-control" id="validationServer03" required name="price" value="{{number_format($product->price, 2)}}" placeholder="0.00">
   </div>
   <div class="col-md-3 mb-3">
     <label for="validationServer03">Preço Promocional (R$)</label>
     <input type="text" class="form-control" id="validationServer03" required name="promotion_price" value="{{number_format($product->promotion_price, 2)}}" placeholder="0.00">
   </div>

      <div class="col-md-3 mb-3">
        <label for="validationServer03">Estoque</label>
        <input type="text" class="form-control" required name="stock" value="{{$product->stock}}"  id="validationServer03" placeholder="" >
      </div>
</div>

<div class="form-row">
   <div class="col-md-3 mb-3">
     <label for="validationServer03">Peso Líquido</label>
     <input type="text" class="form-control" id="validationServer03" required name="weight" value="{{number_format($product->weight, 2)}}" placeholder="">
   </div>
   <div class="col-md-3 mb-3">
     <label for="validationServer03">Peso Bruto</label>
     <input type="text" class="form-control" id="validationServer03" required name="gross_weight" value="{{number_format($product->gross_weight, 2)}}" placeholder="">
   </div>
   <div class="col-md-3 mb-3">
     <label for="validationServer03">Data de Validade</label>
     <input type="date" class="form-control" id="validationServer03" required name="expires_at" value="{{$product->expires_at}}" placeholder="">
   </div>
   <div class="col-md-3 mb-3">
      <label for="validationServer03">Condição</label>
     <select class="custom-select" name="condition">
     <option selected disabled>Selecione...</option>
     <option value="novo">Novo</option>
     <option value="usado">Usado</option>
 </select>
   </div>
</div>


<div class="form-row">
   <div class="col-md-3 mb-3">
     <label for="validationServer03">Largura</label>
     <input type="text" class="form-control" name="width" value="{{number_format($product->width, 2)}}" id="validationServer03" placeholder="Largura">
   </div>
   <div class="col-md-3 mb-3">
     <label for="validationServer03">Altura</label>
     <input type="text" class="form-control" name="heigth" value="{{number_format($product->heigth, 2)}}" id="validationServer03" placeholder="Altura">
   </div>
   <div class="col-md-3 mb-3">
     <label for="validationServer03">Comprimento</label>
     <input type="text" class="form-control" name="length" value="{{number_format($product->length, 2)}}" id="validationServer03" placeholder="Comprimento">
   </div>
   <div class="col-md-3 mb-3">
      <label for="validationServer03">Unidade</label>
     <select class="custom-select" name="unity">
       <option selected disabled>Selecione...</option>
     <option value="mm">Milímetro</option>
     <option value="cm">Centimetro</option>
     <option value="m">Metro</option>
 </select>
   </div>
</div>


<div class="form-row">
   <div class="col-md-3 mb-3">
     <label for="validationServer03">Fabricante</label>
     <select class="custom-select js-example-basic-single" id='brand' name="brand">
       <option selected disabled>Selecione...</option>
       @foreach($brands as $brand)
          <option value='{{$brand->id}}'>{{$brand->name}}</option>
       @endforeach
 </select>
   </div>

   <div class="col-md-3 mb-3">
     <button type="button" class="btn btn btn-success botao_verde btn_carrega_conteudo botao_novo_ajax" data-toggle="modal" data-target="#brandModal">
 Adicionar Fornecedor
</button>
   </div>



<div class="col-md-3 mb-3">
     <label for="validationServer03">Selecionar Categoria</label>
     <select  class="custom-select js-example-basic-single" id='category' name="category">
       <option selected disabled>Selecione...</option>
       @foreach($categorys as $category)
          <option value='{{$category->id}}'>{{$category->name}}</option>
       @endforeach
 </select>

   </div>

   <div class="col-md-3 mb-3">
     <button type="button" class="btn btn btn-success botao_verde btn_carrega_conteudo botao_novo_ajax" data-toggle="modal" data-target="#exampleModal" id="categoria_ajax">
 Adicionar categoria
</button>
   </div>


</div>

<div class="form-group">
   <label for="exampleFormControlTextarea1">Descrição</label>
   <textarea class="form-control" name="description" required id="exampleFormControlTextarea1" rows="3">
   {{$product->description}}</textarea>
 </div>



 <button class="btn btn-success botao_verde" type="submit" name="cadastrar_produto" value="1">Salvar</button>





<!-- Button trigger modal -->


</form>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog" role="document">
   <div class="modal-content">
     <div class="modal-header">
       <h5 class="modal-title" id="exampleModalLabel">Adicionar categoria</h5>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
       </button>
     </div>
     <div class="modal-body" id="div_conteudo">
              <form id="createCategory">
<label for="1233">Adicionar categoria</label>
<div class="row">
   <div class="col-md-8">
     <input type="text" required class="form-control" id="categoria_xd" placeholder="Nome da categoria" name="name">
   </div>

   <div class="col">
     <select class="form-control" required name="active" id="ativo_xd">
       <option value="1">Ativado</option>
       <option value="0">Desativado</option>
     </select>
   </div>
 </div>
 <br />
 <div class="row">
    <div class="col-md-6">
      <label for="inputState">Cor</label>
      <select id="inputState" required name="color" class="form-control">
        <option value="marcas">Vermelho</option>
        <option value="cabelos">Verde</option>
        <option value="maos">Azul</option>
        <option value="casa">Cinza</option>
        <option value="ofertas">Amarelo</option>
      </select>
    </div>

    <div class="col-md-6">
      <label for="inputIcon">Ícone</label>
      <input type="text" name="icon" required class="form-control" placeholder="fa fa-icon" id="inputIcon">
      <div class="pull-right">
          <a href="https://fontawesome.com/icons?d=gallery&m=free" target="_blank">(?)</a>
      </div>
    </div>
  </div>
 <br />
 <button type="button" class="btn btn-success botao_verde btn_carrega_conteudo" id="btnCreateCategory" data-dismiss="modal">Cadastrar</button>
     </div>

   </div>
 </div>
</div>

</form>


<!-- Modal de fornecedores-->
<div class="modal fade" id="brandModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog" role="document">
   <div class="modal-content">
     <div class="modal-header">
       <h5 class="modal-title" id="exampleModalLabel">Adicionar fornecedor</h5>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
       </button>
     </div>
     <div class="modal-body" id="div_conteudo">
              <form id="createBrand">
<div class="row">
   <div class="col-md-12">
     <input type="text" required class="form-control"  placeholder="Nome do fornecedor" name="name">
   </div>
 </div>
 <br />
 <button type="button" class="btn btn-success botao_verde btn_carrega_conteudo" id="btnCreateBrand" data-dismiss="modal">Cadastrar</button>
     </div>

   </div>
 </div>
</div>

</form>
</div>
@endsection

@section("scripts")

<script src="https://cloud.tinymce.com/5/tinymce.min.js?apiKey=y3qwhx7dd59gllbzhzcodgqe5i0c2f7mbfft0etu2qehglrh"></script>
<script>tinymce.init({ selector:'textarea' });</script>
<script type="text/javascript">
  $(document).ready(function(){
    $('.js-example-basic-single').select2();
  });

  $("#btnCreateCategory").on('click', function(e){
    $.get('/admin/categorias/json',$('#createCategory').serialize(), function (data) {
      $("#category").append(`<option value="${data.id}"> ${data.name}</option>`);
      $('#createCategory').trigger("reset");
      alert("Categoria inserida com sucesso");
    });
  });

  $("#btnCreateBrand").on('click', function(e){
    $.get('/admin/fornecedores/json',$('#createBrand').serialize(), function (data) {
      $("#brand").append(`<option value="${data.id}"> ${data.name}</option>`);
      $('#createBrand').trigger("reset");
      alert("Fornecedor inserido com sucesso");
    });
  });
</script>

@endsection
