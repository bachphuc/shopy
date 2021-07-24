<form action="{{Shopy::route('products.index')}}" method="GET">
    <div class="shop__sidebar">
        <div class="sidebar__categories">
            <div class="section-title">
                <h4>@lang('shopy::lang.categories')</h4>
            </div>
            <div class="categories__accordion">
                <div class="accordion" id="accordionExample">
                    @foreach(Shopy::parentCategories() as $key => $category)
                    <div class="card">
                        <div class="card-heading {{$key ? '' : 'active'}}">
                            <a data-toggle="collapse" data-target="#collapse-{{$category->id}}">{{$category->getTitle()}}</a>
                        </div>
                        <div id="collapse-{{$category->id}}" class="collapse show" data-parent="#accordionExample">
                            <div class="card-body">
                                <ul>
                                    @foreach($category->getChildren() as $sub)
                                    <li><a href="{{$sub->getHref()}}">{{$sub->getTitle()}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="sidebar__filter">
            <div class="section-title">
                <h4>@lang('shopy::lang.sort_by_price')</h4>
            </div>
            <div class="filter-range-wrap">
                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                data-min="100000" data-max="2000000" data-current-min="{{request()->query('min_price')}}" data-current-max="{{request()->query('max_price')}}"></div>
                <div>
                    <input type="hidden" id="minamount" name="min_price" />
                    <input type="hidden" id="maxamount" name="max_price" />
                    <p>Giá từ: <span id="label-price-from"></span> VND</p>
                    <p>Đến: <span id="label-price-to"></span> VND</p>
                </div>
            </div>
            {{-- <a href="#">Filter</a> --}}
        </div>

        @foreach(CustomField::field('shopy_product', ['field_type' => 'select_multi']) as $field)
        <div class="sidebar__sizes">
            <div class="section-title">
                <h4>{{$field->getTitle()}}</h4>
            </div>
            <div class="size__list">
                @foreach($field->getOptions() as $opt)
                <label for="{{$field->alias}}-{{$opt}}">
                    {{$opt}}
                    <input type="checkbox" name="{{$field->alias}}[]" id="{{$field->alias}}-{{$opt}}" value="{{$opt}}" {{!empty(request()->query($field->alias)) && (in_array($opt, request()->query($field->alias))) ? 'checked' : '' }} />
                    <span class="checkmark"></span>
                </label>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
    <div>
        <button type="submit" class="btn btn-primary">@lang('shopy::lang.filter_product')</button>
    </div>
</form>

@push('scripts')
<script>
    	window.addEventListener('load', () => {
            const currency = 'VND';
            const rangeSlider = $(".price-range"),
            minamount = $("#minamount"),
            maxamount = $("#maxamount"),
            labelMin = $('#label-price-from'),
            labelMax = $('#label-price-to'),
            minPrice = rangeSlider.data('min'),
            maxPrice = rangeSlider.data('max');
            rangeSlider.slider({
                range: true,
                min: minPrice,
                max: maxPrice,
                step: 100000,
                values: [rangeSlider.data('current-min') ? rangeSlider.data('current-min') : rangeSlider.data('min'), rangeSlider.data('current-max') ? rangeSlider.data('current-max') : rangeSlider.data('max')],
                slide: function (event, ui) {
                    minamount.val(ui.values[0]);
                    maxamount.val(ui.values[1]);
                    labelMin.text(ui.values[0]);
                    labelMax.text(ui.values[1]);
                }
            });
            minamount.val(rangeSlider.slider("values", 0));
            maxamount.val(rangeSlider.slider("values", 1));
            labelMin.text(rangeSlider.slider("values", 0));
            labelMax.text(rangeSlider.slider("values", 1));
        });
</script>
@endpush