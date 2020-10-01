@push('styles')
<style>
ul.steps-bar {
    list-style: none;
    display: flex;
    margin: 0px;
    padding: 0px;
    flex-direction: row;
    margin-top: 16px;
}
.steps-bar li {
    display: inline-block;
    flex: 1;
}
.steps-bar li .step-slider{
    height: 8px;
    background-color: #4caf50;
    margin: 0px 6px;
    position: relative;
    border-radius: 4px;
}
.steps-bar li .step-text{
    text-align: center;
    margin: 16px 0px;
}
.steps-bar li:not(:last-child) .step-slider:before{
    content: '';
    display: block;
    position: absolute;
    width: 16px;
    height: 16px;
    background: #4caf50;
    border-radius: 100%;
    top: -4px;
    right: -8px;
    border: 2px solid #fff;
}
.steps-bar li:not(:last-child) .step-slider::after {
    content: '';
    display: block;
    position: absolute;
    width: 8px;
    height: 8px;
    background: #fff;
    border-radius: 100%;
    top: 0px;
    right: -4px;
}

.steps-bar li.active .step-slider::before{
    width: 24px;
    height: 24px;
    top: -8px;
    right: -12px;
    border: 3px solid #fff;
}

.steps-bar li.active ~ li .step-slider{
    background-color: #e1e1e1;
}

.steps-bar li.active ~ li .step-slider::before{
    background-color: #e1e1e1;
}
.steps-bar li.active ~ li .step-slider::after{
    background-color: #fff;
}

.steps-bar li.processing .step-slider{
    background-color: #ffbc00;
}

.steps-bar li.processing .step-slider::before{
    background-color: #ffbc00;
}

</style>
@endpush

<ul class="steps-bar">
    @foreach($steps as $key => $step)
    <li class="{{isset($step['active']) && $step['active'] ? 'active' : ''}} {{isset($step['processing']) && $step['processing'] ? 'processing' : ''}}">
        <div class="step-slider"></div>
        <div class="step-text">{{$step['title']}}</div>
    </li>
    @endforeach
</ul>