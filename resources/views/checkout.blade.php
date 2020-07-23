@extends('layouts.app_pag_checkout')

@section('content')
<section>
<body class="shop">
    <!--CONTEUDO -->

        <ul class="social-fixed">
            <li>
                <a href="#" target="_blank" title="Facebook">
                    <i class="fa fa-facebook" aria-hidden="true"></i>
                </a>
            </li>
            <li>
                <a href="#" target="_blank" title="Twitter">
                    <i class="fa fa-twitter" aria-hidden="true"></i>
                </a>
            </li>
            <li>
                <a href="#" target="_blank" title="Instagram">
                    <i class="fa fa-instagram" aria-hidden="true"></i>
                </a>
            </li>
            <li>
                <a href="#" target="_blank" title="Wordpress">
                    <i class="fa fa-wordpress" aria-hidden="true"></i>
                </a>
            </li>
        </ul>

        <div class="cover-all">

            <div class="frete-info">
                <div class="close">
                    <i class="fa fa-window-close-o" aria-hidden="true"></i>
                </div>
                <strong>
                    <i class="fa fa-truck" aria-hidden="true"></i> Política de Frete
                </strong>
                <p>
                    A Plena Natura oferece frete grátis para as compras acima de R$99,90 com algumas excessões.<br><br>
                    Na página de pagamento você poderá ver se há ou não a opção de frete grátis de acordo com o CEP de entrega e os produtos escolhidos. <a href="fretes-e-prazos.html" target="_blank" title="Saiba mais">Saiba mais</a>
                </p>

            </div>
            <div class="frete-cart">
                <div class="close">
                    <i class="fa fa-window-close-o" aria-hidden="true"></i>
                </div>
                <table class="frete-table" border="1">
                    <thead>
                        <tr>
                            <td>

                            </td>
                            <td>
                                Entrega em:
                            </td>
                            <td>
                                Valor
                            </td>
                            <td>

                            </td>
                        </tr>
                    </thead>
                    <tbody>

                        {{-- @dd($shippiments); --}}

                        @if(count($shippiments) > 0)
                            @foreach($shippiments as $shippiment)
                                <tr>
                                    <td>
                                        <span>
                                            {{ $shippiment->name }}
                                        </span>
                                    </td>
                                    <td>
                                        <span>
                                            {{ $shippiment->deadline }} dias
                                        </span>
                                    </td>
                                    <td>
                                        <span>
                                            R$ {{ money($shippiment->price) }}
                                        </span>
                                    </td>
                                    <td>
                                        <input type="checkbox">
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <header class="fixed">
            <section class="container-header">
                <div class="wrapper">
                    <div class="pad">
                        <h1>
                            <a href="{{url('/')}}" title="Plena Natura - Cosméticos Naturais">
                                <img src="{{url('images/plena-natura-cosmeticos-naturais.jpg')}}" alt="Plena Natura - Cosméticos Naturais">
                            </a>
                        </h1>

                        <ul class="timeline">
                            <li class="checked">
                                <div class="item">

                                </div>
                                <span>
                                    Carrinho
                                </span>
                            </li>
                            <li class="checked">
                                <div class="item">

                                </div>
                                <span>
                                    Identificação
                                </span>
                            </li>
                            <li class="checked last">
                                <div class="item">

                                </div>
                                <span>
                                    Checkout
                                </span>
                            </li>
                            <li>
                                <div class="item">

                                </div>
                                <span>
                                    Recibo
                                </span>
                            </li>
                        </ul>


                        <a href="tel:1933842744" class="fone-shop">
                            <i class="fa fa-phone" aria-hidden="true"></i> (19) 3384-2744
                        </a>
                    </div>
                </div>
            </section>
        </header>
        <!--HEADER / END -->



        <!-- MIOLO -->

        <section class="container-miolo margin-top scrolled">
            <div class="wrapper">
                <div class="cart">

                    <div class="div">
                        <p class="alert alert-danger">Erro ao fazer pagamento, entre em contato com o suporte</p>
                    </div>

                    <h2>
                        Endereço e pagamento
                    </h2>

                    <form class="steps" id="pay">
                        <div class="col-checkout">
                            <div class="tabela" id="customerInfo">
                                <h3>
                                    1. Informações do Cliente
                                </h3>
                                <div class="body-table">
                                    <div class="form-wrapper">
                                        <label>
                                            <span>
                                                E-mail
                                            </span>
                                            <input type="email" name="email" id="email" required>
                                        </label>
                                        <label>
                                            <span>
                                                Senha
                                            </span>
                                            <input type="password" id="password">
                                        </label>
                                        <label>
                                            <span>
                                                Confirmar
                                            </span>
                                            <input type="password" id="confirmPassword">
                                        </label>
                                        <label>
                                            <span>
                                                CPF
                                            </span>
                                            <input type="text" id="docNumber" data-checkout="docNumber" required>
                                        </label>
{{--                                        <label for="docType">--}}
{{--                                            <span>Tipo de Documento</span>--}}
{{--                                            <select id="docType" data-checkout="docType"></select>--}}
{{--                                        </label>--}}
                                        <label>
                                            <span>
                                                Nome
                                            </span>
                                            <input type="text" id="first_name" name="first_name" required>
                                        </label>
                                        <label>
                                            <span>
                                                Sobrenome
                                            </span>
                                            <input type="text" id="last_name" name="last_name" required>
                                        </label>
                                        <label>
                                            <span>
                                                Nascimento
                                            </span>
                                            <input type="text" id="birth_date" name="birth_date" required>
                                        </label>
                                        <label>
                                            <span>
                                                Sexo
                                            </span>
                                            <input type="text" id="gender" name="gender">
                                        </label>
                                    </div>
                                </div>
                            </div>



                            <div class="tabela">
                                <h3>
                                    2. Endereço de Entrega
                                </h3>
                                <div class="body-table">
                                    <div class="form-wrapper">
                                        <label>
                                            <span>
                                                CEP
                                            </span>
                                            <input name="shipping_zipcode" type="text">
                                        </label>
                                        <label>
                                            <span>
                                                Rua
                                            </span>
                                            <input name="shipping_street" type="text">
                                        </label>
                                        <label>
                                            <span>
                                                Número
                                            </span>
                                            <input name="shipping_number" type="text">
                                        </label>
                                        <label>
                                            <span>
                                                Complemento
                                            </span>
                                            <input name="shipping_address2" type="text">
                                        </label>
                                        <label>
                                            <span>
                                                Bairro
                                            </span>
                                            <input name="shipping_neighborhood" type="text">
                                        </label>
                                        <label>
                                            <span>
                                                Cidade
                                            </span>
                                            <input name="shipping_city" type="text">
                                        </label>
                                        <label>
                                            <span>
                                                Estado
                                            </span>
                                            <input name="shipping_state" type="text">
                                        </label>
                                        <label>
                                            <span>
                                                Telefone
                                            </span>
                                            <input type="text" name="shipping_phone" id="phone">
                                        </label>
                                        <label>
                                            <span>
                                                Celular
                                            </span>
                                            <input type="text" name="shipping_cellphone" id="cel">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-checkout">
                            <div class="tabela">
                                <h3>
                                    3. Opções de Entrega
                                </h3>
                                <div class="body-table">
                                    <div class="form-wrapper">
                                        @if(count($shippiments) > 0)
                                            @foreach($shippiments as $shippiment)
                                                @if($shippiment->price != 0)
                                                    <label class="select">
                                                        <input name="frete" type="radio">
                                                        <strong>{{ $shippiment->name }}</strong>
                                                        <span>
                                                            {{ $shippiment->deadline }} dias
                                                        </span>
                                                        <span>
                                                            R${{ money($shippiment->price) }}
                                                        </span>

                                                        <div class="info-label">
                                                            <p>
                                                                O pedido será liberado somente após a aprovação do pagamento.
                                                            </p>
                                                        </div>
                                                    </label>
                                                @endif
                                            @endforeach
                                        @endif
                                        <em>
                                            Frete grátis: Compras acima de R$ 99,90. <a href="#" id="rule">Confira a regra.</a><br><br>
                                            O pedido será liberado somente após a aprovação do pagamento
                                        </em>
                                    </div>
                                </div>
                            </div>



                            <div class="tabela">
                                <h3>
                                    4. Formas de Pagamento
                                </h3>
                                <div class="body-table">
                                    <div class="form-wrapper">
{{--                                        <label class="select">--}}
{{--                                            <input name="pagamento" type="radio">--}}
{{--                                            <strong>Débito em conta</strong>--}}
{{--                                            <div class="info-label">--}}
{{--                                                <label class="select">--}}
{{--                                                    <input name="debito" type="radio">--}}
{{--                                                    <img src="images/cc/caixa.jpg" alt="Caixa">--}}
{{--                                                </label>--}}
{{--                                                <label class="select">--}}
{{--                                                    <input name="debito" type="radio">--}}
{{--                                                    <img src="images/cc/bradesco.jpg" alt="Bradesco">--}}
{{--                                                </label>--}}
{{--                                                <p>--}}
{{--                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae diam sit amet tellus imperdiet .--}}
{{--                                                </p>--}}
{{--                                            </div>--}}
{{--                                        </label>--}}
{{--                                        <label class="select">--}}
{{--                                            <input name="pagamento" type="radio">--}}
{{--                                            <strong>Boleto Bancário</strong>--}}
{{--                                            <div class="info-label">--}}
{{--                                                <ul>--}}
{{--                                                    <li>--}}
{{--                                                        Pagamento somente à vista.--}}
{{--                                                    </li>--}}
{{--                                                    <li>--}}
{{--                                                        O boleto vence em 3 dias.--}}
{{--                                                    </li>--}}
{{--                                                    <li>--}}
{{--                                                        É necessário imprimir o boleto ou utilizar o código de barras do mesmo para fazer o pagamento.--}}
{{--                                                    </li>--}}
{{--                                                    <li>--}}
{{--                                                        Imprima o boleto após a finalização da compra.--}}
{{--                                                    </li>--}}
{{--                                                    <li>--}}
{{--                                                        O boleto não será enviado para o seu endereço físico.--}}
{{--                                                    </li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
{{--                                        </label>--}}
{{--                                        <label class="select outros">--}}
{{--                                            <input name="pagamento" type="radio" checked>--}}
{{--                                            <strong>Mercado Pago</strong>--}}
{{--                                            <div class="info-label">--}}
{{--                                                <p>--}}
{{--                                                    Finalize sua compra com MercadoPago. É muito simples e seguro:--}}
{{--                                                </p>--}}
{{--                                                <ul>--}}
{{--                                                    <li>--}}
{{--                                                         Finalize a compra.--}}
{{--                                                    </li>--}}
{{--                                                    <li>--}}
{{--                                                        Selecione seu meio de pagamento preferido.--}}
{{--                                                    </li>--}}
{{--                                                    <li>--}}
{{--                                                       Confirme o pagamento.--}}
{{--                                                    </li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
{{--                                            <div class="info-label">--}}
{{--                                                <div class="form">--}}
{{--                                                    <label>--}}
{{--                                                            <span>--}}
{{--                                                                N<sup>o</sup> do Cartão--}}
{{--                                                            </span>--}}
{{--                                                        <input type="text">--}}
{{--                                                    </label>--}}
{{--                                                    <label>--}}
{{--                                                            <span>--}}
{{--                                                                N<sup>o</sup> de Parcelas--}}
{{--                                                            </span>--}}
{{--                                                        <select>--}}
{{--                                                            <option>1x de R$400,00</option>--}}
{{--                                                            <option>2x de R$200,00</option>--}}
{{--                                                            <option>3x de R$150,00</option>--}}
{{--                                                        </select>--}}
{{--                                                    </label>--}}
{{--                                                    <label>--}}
{{--                                                            <span class="l2">--}}
{{--                                                               Seu nome<br><small>(como no cartão)</small>--}}
{{--                                                            </span>--}}
{{--                                                        <input type="text">--}}
{{--                                                    </label>--}}
{{--                                                    <label>--}}
{{--                                                            <span>--}}
{{--                                                                Vencimento--}}
{{--                                                            </span>--}}
{{--                                                        <div class="fl">--}}
{{--                                                            <select>--}}
{{--                                                                <option>Mês</option>--}}
{{--                                                            </select>--}}
{{--                                                            <select>--}}
{{--                                                                <option>Ano</option>--}}
{{--                                                            </select>--}}

{{--                                                        </div>--}}
{{--                                                    </label>--}}
{{--                                                    <label>--}}
{{--                                                            <span>--}}
{{--                                                               Cód. de Segurança--}}
{{--                                                            </span>--}}
{{--                                                        <input type="text">--}}
{{--                                                    </label>--}}
{{--                                                    <label class="select">--}}
{{--                                                        <input type="checkbox"> <span>Salvar cartão para próxima compra</span>--}}
{{--                                                    </label>--}}
{{--                                                    <label class="select">--}}
{{--                                                        <input type="checkbox"> <span>Tornar padrão para a próxima compra</span>--}}
{{--                                                    </label>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </label>--}}
                                        <label class="select open">
                                            <input name="pagamento" type="radio" checked>
                                            <strong>Cartão de Crédito</strong>
                                            <div class="info-label">
{{--                                                <label class="select cc">--}}
{{--                                                    <input name="cc" type="radio">--}}
{{--                                                    <img src="images/cc/amex.jpg" alt="Amex">--}}
{{--                                                    <span>paulo s cardoso</span>--}}
{{--                                                    <span>****.****.****.3988</span>--}}
{{--                                                </label>--}}
{{--                                                <label class="select cc">--}}
{{--                                                    <input name="cc" type="radio">--}}
{{--                                                    <img src="images/cc/mastercard.jpg" alt="Mastercad">--}}
{{--                                                    <span>paulo s cardoso</span>--}}
{{--                                                    <span>****.****.****.3988</span>--}}
{{--                                                </label>--}}
                                                <label class="select outros">
{{--                                                    <input name="cc" type="radio">--}}
{{--                                                    <span>Inserir novo cartão</span>--}}
                                                    <div class="form open">
                                                        <label>
                                                            <span>
                                                                N<sup>o</sup> do Cartão
                                                            </span>
                                                            <input type="text" name="card_number" id="card_number" data-checkout="cardNumber">
                                                        </label>
                                                        <label>
                                                            <span>
                                                                N<sup>o</sup> de Parcelas
                                                            </span>

                                                            <select name="installments" id="installments">
                                                            </select>
                                                        </label>
                                                        <label>
                                                            <span class="l2">
                                                               Seu nome<br><small>(como no cartão)</small>
                                                            </span>
                                                            <input type="text" name="card_name" id="card_name" data-checkout="cardholderName">
{{--                                                            <input type="text" name="card_name" id="card_name" data-checkout="cardholderName"--}}
                                                        </label>
                                                        <label>
                                                            <span>
                                                                Vencimento
                                                            </span>
                                                            <div class="fl">
                                                                <select name="card_month" id="card_month" data-checkout="cardExpirationMonth">
                                                                    <option>Mês</option>
                                                                    @foreach(months() as $month_number => $month_name)
                                                                        <option value="{{ $month_number }}">{{ $month_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <select name="card_year" id="card_year" data-checkout="cardExpirationYear">
                                                                    <option>Ano</option>
                                                                    @foreach(years() as $y)
                                                                        <option value="{{ $y }}">{{ $y }}</option>
                                                                    @endforeach
                                                                </select>

                                                            </div>
                                                        </label>
                                                        <label>
                                                            <span>
                                                               Cód. de Segurança
                                                            </span>
                                                            <input type="text" name="ccv" id="ccv" data-checkout="securityCode">
                                                        </label>
{{--                                                        <label class="select">--}}
{{--                                                            <input type="checkbox"> <span>Salvar cartão para próxima compra</span>--}}
{{--                                                        </label>--}}
{{--                                                        <label class="select">--}}
{{--                                                            <input type="checkbox"> <span>Tornar padrão para a próxima compra</span>--}}
{{--                                                        </label>--}}
                                                    </div>
                                                </label>

                                                <input type="hidden" name="payment_method_id" id="payment_method_id" />
                                                <input type="hidden" id="docType" data-checkout="docType" value="CPF" />
                                                <input type="hidden" name="transaction_amount" id="transaction_amount" value="{{ cartTotal() }}" />
                                            </div>
                                        </label>
{{--                                        <label class="select">--}}
{{--                                            <input name="pagamento" type="radio">--}}
{{--                                            <strong>Bitcoin</strong>--}}
{{--                                            <div class="info-label">--}}
{{--                                                <p>--}}
{{--                                                    O pedido será liberado somente após a aprovação do pagamento. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae diam sit amet tellus imperdiet .--}}
{{--                                                </p>--}}
{{--                                            </div>--}}
{{--                                        </label>--}}
                                        <em>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae diam sit amet tellus imperdiet .
                                        </em>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-checkout">
                            <div class="tabela">
                                <h3>
                                    5. Revisão do pedido
                                </h3>
                                <div class="body-table">
                                    <table class="cart-m">
                                        @if(count($products) > 0)
                                            @foreach($products as $product)
                                                @php
                                                    $p = product($product['product_id']);
                                                @endphp
                                                <tr>
                                            <td>
                                                <img src="{{ $p->thumbnail() }}" alt="Nome do Produto">
                                            </td>
                                            <td>
                                                <strong>
                                                    {{$p->name}}
                                                </strong>
                                                <span>
                                                    Tamanho: 100ml<br>
                                                    Quantidade: {{$product['quantity']}}
                                                </span>
                                            </td>
                                            <td>
                                                <strong>
                                                    R$ {{money($p->price *  $product['quantity'])}}
                                                </strong>
                                            </td>
                                        </tr>
                                            @endforeach
                                        @endif
                                    </table>

                                    <h4>
                                        <i class="fa fa-ticket" aria-hidden="true"></i> Cupons e Vales
                                    </h4>
                                    <div class="form-wrapper">
                                        <label class="ticket">
                                            <input type="text" placeholder="Cupom de Desconto">
                                            <button>OK</button>
                                        </label>
                                        <label class="ticket">
                                            <input type="text" placeholder="Vale">
                                            <button>OK</button>
                                        </label>
                                    </div>
                                    <h4>
                                        <i class="fa fa-dollar" aria-hidden="true"></i> Valores
                                    </h4>
                                    <table class="value">
                                        <tr>
                                            <td>
                                                Subtotal
                                            </td>
                                            <td>
                                                R$ {{ money(cartTotal()) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Descontos
                                            </td>
                                            <td>
                                                R$ <span id="total_discount">0,00</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Entrega
                                            </td>
                                            <td>
                                                R$ <span id="shipping_total">0,00</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Total
                                            </td>
                                            <td>
                                                R$ {{ money(cartTotal()) }}
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <a href="javascript:void(0)" class="button-shop" id="submitCheckout">
                                Finalizar Pedido
                            </a>
                        </div>
                    </form>


                </div>

            </div>
        </section>

        <!-- JS PLUGINS -->

        <script type="text/javascript" src="javascripts/custom.js">
        </script>



        <!-- SCRIPTS / END -->


        <!-- GOOGLE ANALYTICS -->


        <!--GOOGLE ANALYTICS / END-->


    <!--CONTEUDO / END -->

</body>

</section>

@endsection


