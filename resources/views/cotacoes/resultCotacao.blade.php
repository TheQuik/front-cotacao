<div class="alert alert-light" role="alert">
    @php
        $convertText = [
            'bid'=> 'Compra',
            'ask'=> 'Venda',
            'varBid'=> 'Variação',
            'pctChange'=>'Porcentagem de Variação',
            'high'=>'Máximo',
            'low'=>'Mínimo'
        ];
    @endphp
    @if ($status == 200)
        <h4 class="alert-heading">{{ $data->name }}</h4>
        <div class="col-md-6">Compra: {{ $data->bid }}</div>
        <div class="col-md-6">Venda: {{ $data->ask }}</div>
        <div class="col-md-6">Variação: {{ $data->varBid }}</div>
        <div class="col-md-12">Porcentagem de Variação: {{ $data->pctChange }}%</div>
        <div class="col-md-6">Máximo: {{ $data->high }}</div>
        <div class="col-md-6">Mínimo: {{ $data->low }}</div>
    @else

    @endif

</div>
