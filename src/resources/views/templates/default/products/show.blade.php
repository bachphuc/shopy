@extends(Shopy::layout())

@push('styles')
<style>
    .field-checkbox{
        margin-right: 4px;
    }
    .field-checkbox input{
        opacity: 0;
        position: absolute;
        width: 1px;
        height: 1px;
        margin-right: 8px;
    }
    .field-checkbox label{
        border: 1px solid #ccc;
        padding: 2px 8px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        font-size: 0.82em;
        border-radius: 2px;
    }
    .field-checkbox.field-color label{
        height: 24px;
        width: 24px;
        border: 2px solid transparent;
        box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);
        border-radius: 2px;
    }

    .field-checkbox input:checked + label{
        border-color: red;
    }
    .field-checkbox input:disabled + label{
        color: #ddd;
        border-color: #e1e1e1;
    }
    .field-checkbox.field-color input:checked + label{
        border-color: #000;
    }
    .field-checkbox.field-color input:disabled + label{
        opacity: 0.5;
        border-color: transparent;
    }
    
</style>
@endpush

@section('content')
    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__left product__thumb nice-scroll">
                            @foreach($product->getImages() as $key => $img)
                            <a class="pt active" href="#product-{{$key+1}}">
                                <img src="{{$img->getImage()}}" alt="">
                            </a>
                            @endforeach
                        </div>
                        
                        <div class="product__details__slider__content">
                            <div class="product__details__pic__slider owl-carousel">
                                @foreach($product->getImages() as $key => $img)
                                <img data-hash="product-{{$key + 1}}" class="product__big__img" src="{{$img->getImage()}}" alt="">
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product__details__text">
                        <form action="{{Shopy::route('carts.store')}}" method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="product_id" value="{{$product->id}}" />
                            <input id="variant_id" type="hidden" name="variant_id" value="{{isset($selectedVariant) ? $selectedVariant->id : 0}}" />
                            <h3>{{$product->getTitle()}} 
                                @if($product->hasCustomField('brand'))<span>Brand: {{$product->field('brand')}}</span>@endif
                            </h3>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <span>( 138 reviews )</span>
                            </div>
                            <div class="product__details__price">$ <span id="product__details__price_amount">{{$product->getPriceOf($selectedVariant)}}</span> <span class="product__details__price__discount">$ 83.0</span></div>
                            
                            <div class="product__details__button">
                                <div class="quantity">
                                    <span>Quantity:</span>
                                    <div class="pro-qty">
                                        <input name="count" type="text" value="1" />
                                    </div>
                                </div>
                                <button class="cart-btn" type="submit"><span class="icon_bag_alt"></span> Add to cart</button>
                                <ul>
                                    <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                    <li><a href="#"><span class="icon_adjust-horiz"></span></a></li>
                                </ul>
                            </div>
                            <div class="product__details__widget">
                                <ul>
                                    <li>
                                        <span>Availability:</span>
                                        <div class="stock__checkbox">
                                            <label for="stockin">
                                                In Stock
                                                <input type="checkbox" id="stockin">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </li>
                                    {{-- BEGIN custom field for variant --}}
                                    @if(isset($customFields) && !empty($customFields))
                                    @foreach($customFields as $key => $field)
                                    <li>
                                        <span>Available {{$field->getTitle()}}:</span>
                                        <div class="field-group {{$field->data_type ? 'field-group-'. $field->data_type : ''}}">
                                            @foreach($field->getOptions() as $opt)
                                            <label class="field-checkbox {{$field->data_type ? 'field-'. $field->data_type : ''}}">
                                                <input data-field-index="{{$key}}" class="field-checkbox-radio" type="radio" name="{{$field->alias}}" id="field-{{$field->alias}}-{{$opt}}" value="{{$opt}}" {{isset($selectedVariant) && $selectedVariant->hasOption($field->alias, $opt) ? 'checked' : ''}} >
                                                @if($field->data_type === 'color')
                                                <label for="field-{{$field->alias}}-{{$opt}}" style="background-color: {{$opt}};"></label>
                                                @else
                                                <label for="field-{{$field->alias}}-{{$opt}}">{{$opt}}</label>
                                                @endif
                                            </label>
                                            @endforeach
                                        </div>
                                    </li>
                                    @endforeach
                                    @endif
                                    {{-- END custom field for variant --}}
                                    <li>
                                        <span>Promotions:</span>
                                        <p>Free shipping</p>
                                    </li>
                                </ul>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Specification</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Reviews ( 2 )</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <h6>Description</h6>
                                <p>{{$product->description}}</p>
                                @if($product->hasCustomField('privacy'))
                                <h6>Privacy</h6>
                                <p>{{$product->field('privacy')}}</p>
                                @endif
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <h6>Specification</h6>
                                <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed
                                    quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt loret.
                                    Neque porro lorem quisquam est, qui dolorem ipsum quia dolor si. Nemo enim ipsam
                                    voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed quia ipsu
                                    consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nulla
                                consequat massa quis enim.</p>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget
                                    dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,
                                    nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium
                                quis, sem.</p>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <h6>Reviews ( 2 )</h6>
                                <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed
                                    quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt loret.
                                    Neque porro lorem quisquam est, qui dolorem ipsum quia dolor si. Nemo enim ipsam
                                    voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed quia ipsu
                                    consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nulla
                                consequat massa quis enim.</p>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget
                                    dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,
                                    nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium
                                quis, sem.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include(Shopy::viewPath('products.related'), ['product' => $product])
        </div>
    </section>
    <!-- Product Details Section End -->

    <script>
        const variants = {!! json_encode($variants->toArray()) !!};
        const customFields = {!! json_encode($arrCustomFields) !!};

        var valueOfRows, allVariants, indexAvailableCases = {};
        window.addEventListener('load', () => {
            document.querySelectorAll(`.field-checkbox input[type=radio]`).forEach(ele => {
                ele.addEventListener('change', (e) => {
                    fieldChanged(e);
                });
            })
            
            initCustomFields();

            allVariants = initCases();

            fieldChanged();
        })

        function initCustomFields(){
            valueOfRows = Array(customFields.length).fill(1);
            customFields.forEach((c, cIndex) => {
                valueOfRows.forEach((v, vIndex) => {
                    if(cIndex > vIndex){
                        valueOfRows[vIndex]*= c.options.length;
                    }
                })
            });
        }

        function fieldChanged(e){
            if(!variants.length){
                console.log(`there is no variants found`);
                document.querySelectorAll('.field-checkbox-radio').forEach(e => {
                    e.disabled = true;
                })
                return;
            }
            const values = getSelectedFieldValues();

            let variant = variants.find(v => compareVariant(v, values));
            if(!variant){
                if(!e) return;
                const fieldIndex = parseInt(e.target.dataset['fieldIndex']);
                // there is no variant found
                const availableCase = getMaybeCase(fieldIndex, values);
                if(availableCase){
                    // update price
                    variant = indexAvailableCases[availableCase.key];
                    document.getElementById('product__details__price_amount').innerText = variant.price;
                    // make these conditions active
                    customFields.forEach((c, cIndex) => {
                        document.getElementById(`field-${c.alias}-${availableCase[c.alias]}`).checked = true;
                    })
                    document.getElementById('variant_id').value = variant.id;
                }
                else{
                    console.log(`No variant found with condition: ${JSON.stringify(values)}, fieldIndex: ${fieldIndex}`);
                    console.log(`cannot find available case to auto select => bug`);
                }
            }
            else{
                // update price
                document.getElementById('product__details__price_amount').innerText = variant.price;
                document.getElementById('variant_id').value = variant.id;
            }

            // update state of values
            customFields.forEach( (f, fIndex) => {
                if(f.options){
                    f.options.forEach((o, oIndex) => {
                        const ele = document.getElementById(`field-${f.alias}-${o}`);
                        
                        const hasVariant = variants.find(v => maybeHaveVariant(v, f, fIndex, values, o, oIndex));
                        ele.disabled = hasVariant ? false : true;
                    })
                }
            })
        }

        function maybeHaveVariant(v, f, fIndex, values, o, oIndex){
            // check direct
            const checkValues = Object.assign({}, values);
            checkValues[f.alias] = o;

            const hasVariant = variants.find(v => compareVariant(v, checkValues));
            if(hasVariant) return true;

            const maybeCase = getMaybeCase(fIndex, checkValues);
            if(maybeCase) return true;

            return false;
            // check if at least one of variant for this option
            $result = false;
            for(let i = fIndex + 1; i < customFields.length; i++){
                const currentF = customFields[i];

            }
            return $result;
        }

        function getMaybeCase(currentFIndex, values){
            customFields.forEach((f, fIndex) => {
                if(fIndex > currentFIndex){
                    if(values[f.alias] !== undefined){
                        delete values[f.alias];
                    }
                }
            })

            return allVariants.find(v => v.is_available && compareVariant(v, values));
        }

        function compareVariant(variant, values){
            let result = true;
            for(let k in values){
                if(result && variant[k] !== values[k]){
                    result = false;
                }
            }
            return result;
        }

        function getSelectedFieldValues(){
            let result = {};
            customFields.forEach(e => {
                const ele = document.querySelector(`input.field-checkbox-radio[name=${e.alias}]:checked`);
                if(ele){
                    result[e.alias] = ele.value;
                }
            });
            return result;
        }

        function createBlankVariant(){
            return new Array(customFields.length);
        }

        function initCases(){
            let total = 1;
            customFields.forEach((f, fIndex) => {
                total*=f.options.length;
            })

            variants.forEach(v => {
                indexAvailableCases[v.values] = v;
            })

            const results = [];
            for(let i = 0; i < total; i++){
                results.push(translateIndex(i));
            }

            return results;
        }

        function translateIndex(value){
            let remain = value;
            let result = {};
            let options = [];
            for(let i = 0; i < valueOfRows.length; i++){
                const v = Math.floor(remain / valueOfRows[i]);
                result[customFields[i].alias] = customFields[i].options[v];
                remain = remain - (v * valueOfRows[i]);
                options.push(customFields[i].options[v]);
            }

            result.key = options.join(',');
            if(indexAvailableCases[result.key]){
                result.is_available = true;
            }

            return result;
        }
    </script>
@endsection