
@extends('layouts.app')

@section('content')
    <div class="content pt-2">
        <div class="container-fluid">
            <div class="card card-orange">
                <div class="card-header">
                    <h3 class="card-title text-white-50">{{ __('lucky.lucky draw create') }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('lucky.store') }}" method="POST">
                        @csrf
                    <div class="row">
                        <div class="col-3">
                            <label for="lucky_no">{{ __('lucky.lucky no') }}</label>
                            <input name="lucky_no" id="lucky_no" type="text" value="{{ old('lucky_no') }}" class="form-control" placeholder="{{ __('lucky.lucky no') }}">
                        </div>
                        <div class="col-4">
                            <label for="amount">{{ __('lucky.amount') }}</label>
                            <input name="amount" autofocus id="amount" value="{{ old('amount') }}" type="text" class="form-control" placeholder="{{ __('lucky.amount') }}">
                        </div>
                        <div class="col-5">
                            <label for="mtl_value">{{ __('lucky.material amount') }}</label>
                            <input name="mtl_value" value="{{ old('mtl_value') }}" id="mtl_value" type="text" class="form-control" placeholder="{{ __('lucky.material amount') }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="mtl">{{ __('lucky.material') }}</label>
                            <textarea name="mtl" id="mtl" class="form-control">{{ old('mtl') }}</textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <label for="donor">{{ __('lucky.donor name') }}</label>
                            <textarea id="donor" name="donor" class="form-control">{{ old('donor') }}</textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <label for="address">{{ __('lucky.address') }}</label>
                            <textarea name="address" id="address" class="form-control">{{ old('address') }}</textarea>
                        </div>
                    </div>
                        <div class="pt-2">
                            <button class="btn btn-success" type="submit">{{ __('lucky.save') }}</button>
                        </div>

                    </form>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>

@endsection

@push('page_scripts')
<!-- <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
<script type="text/javascript">
    
    const material = new autoComplete({
            selector: "#mtl",
            placeHolder: "လှူဖွယ်ပစ္စည်း",
            data: {
                src: 
                [

                "ပြက္ခဒိန် (၁)ခု",
                "ဘုရားပုံတော် (၁)ဆူ",
                "ထီး (၁)လက်၊ ဖိနပ် (၁)ရံ၊ ယပ် (၁)ချောင်း",
                "အနေကထိုင် (၁)ခု",
                "သင်္ကန်းခြင်းကြီး (၁)ခြင်း",
                "ဆန်(၁)အိပ်၊ ဆီ (၁) ပုံး",
                "သင်္ကန်းခြင်း (၁)ခြင်း",
                "သင်္ကန်းဒွိစုံ (၁)စုံ"

                ],
                cache: true,
            },
            resultsList: {
                element: (list, data) => {
                    if (!data.results.length) {
                        // Create "No Results" message element
                        const message = document.createElement("div");
                        // Add class to the created element
                        message.setAttribute("class", "no_result");
                        // Add message text content
                        message.innerHTML = `<span>Found No Results for "${data.query}"</span>`;
                        // Append message element to the results list
                        list.prepend(message);
                    }
                },
                noResults: true,
            },
            resultItem: {
                highlight: true
            },
            events: {
                input: {
                    selection: (event) => {
                        const selection = event.detail.selection.value;
                        material.input.value = selection;
                    }
                }
            }
        });

    const address = new autoComplete({
            selector: "#address",
            placeHolder: "နေရပ်လိပ်စာ",
            data: {
                src: ["လှည်းတန်း",
                "အမှတ်()၊ လမ်း၊ (၈)ရပ်ကွက်၊ ရှောက်ပင်ခြံ၊ ကမာရွတ်။",
                "အမှတ်()၊ စံပါယ် ()လမ်း၊ (၃)ရပ်ကွက်၊ ကမာရွတ်။",
                "အမှတ်()၊ မဟာဘောဂလမ်း၊ (၃)ရပ်ကွက်၊ ကမာရွတ်။",
                "အမှတ်()၊ ပုလဲဂေဟာလမ်းသွယ်၊ (၃)ရပ်ကွက်၊ ကမာရွတ်။",
                "အမှတ်()၊ လှည်းတန်း()လမ်း၊ (၃)ရပ်ကွက်၊ ကမာရွတ်။",
                "အမှတ်()၊ လင်းရောင်ခြည်လမ်း၊ (၃)ရပ်ကွက်၊ ကမာရွတ်။",
                "အမှတ်()၊ ပန်းခြံလမ်း၊ (၃)ရပ်ကွက်၊ ကမာရွတ်။",
                "အမှတ်()၊ ပတ္တမြားလမ်း၊ (၃)ရပ်ကွက်၊ ကမာရွတ်။",
                "အမှတ်()၊ ထန်းတပင်အနောက်ပိုင်းလမ်း၊ (၃)ရပ်ကွက်၊ ကမာရွတ်။",
                "အမှတ်()၊ ဇေယျာသီရိလမ်း၊ (၁)ရပ်ကွက်၊ ကမာရွတ်။",
                "ကြည့်မြင်တိုင်မြို့နယ်",
                "မြောက်ဥက္ကလာပမြို့နယ်",
                "ရွှေပြည်သာမြို့နယ်",
                "အမှတ်()၊ ခိုင်ရွှေဝါလမ်း၊ (၃)ရပ်ကွက်၊ ကမာရွတ်။",
                "အမှတ်()၊ ထန်းတပင်လမ်းမ၊ (၃)ရပ်ကွက်၊ ကမာရွတ်။",
                "အမှတ်()၊ ကွမ်းခြံ()လမ်း၊ (၄)ရပ်ကွက်၊ ကမာရွတ်။",
                "အမှတ်()၊ ပုလဲဂေဟာလမ်း၊ (၃)ရပ်ကွက်၊ ကမာရွတ်။",
                "အမှတ်()၊ ရတနာမြိုင်လမ်း၊ (၃)ရပ်ကွက်၊ ကမာရွတ်။",
                "အမှတ်()၊ ဦးထွန်းလင်းခြံလမ်း၊ (၃)ရပ်ကွက်၊ ကမာရွတ်။",
                "အမှတ်()၊ စေတနာသုခလမ်း၊ (၃)ရပ်ကွက်၊ ကမာရွတ်။"
                ],
                cache: true,
            },
            resultsList: {
                element: (list, data) => {
                    if (!data.results.length) {
                        // Create "No Results" message element
                        const message = document.createElement("div");
                        // Add class to the created element
                        message.setAttribute("class", "no_result");
                        // Add message text content
                        message.innerHTML = `<span>Found No Results for "${data.query}"</span>`;
                        // Append message element to the results list
                        list.prepend(message);
                    }
                },
                noResults: true,
            },
            resultItem: {
                highlight: true
            },
            events: {
                input: {
                    selection: (event) => {
                        const selection = event.detail.selection.value;
                        address.input.value = selection;
                    }
                }
            }
        });

    const donar = new autoComplete({
            selector: "#donor",
            placeHolder: "အလှူရှင်အမည်",
            data: {
                src: [
                "မိသားစု ကောင်းမှု",
                "ကွယ်လွန်သူမိဘများဖြစ်ကြသော  မိသားစုကောင်းမှု။",
                "ကွယ်လွန်သူများဖြစ်ကြသော"
               
                ],
                cache: true,
            },
            resultsList: {
                element: (list, data) => {
                    if (!data.results.length) {
                        // Create "No Results" message element
                        const message = document.createElement("div");
                        // Add class to the created element
                        message.setAttribute("class", "no_result");
                        // Add message text content
                        message.innerHTML = `<span>Found No Results for "${data.query}"</span>`;
                        // Append message element to the results list
                        list.prepend(message);
                    }
                },
                noResults: true,
            },
            resultItem: {
                highlight: true
            },
            events: {
                input: {
                    selection: (event) => {
                        const selection = event.detail.selection.value;
                        donar.input.value = selection;
                    }
                }
            }
        });
    

   //var suggests = ["ပြက္ခဒိန် (၁)ခု", "ဘုရားပုံတော် (၁)ဆူ","သင်္ကန်းဒွိစုံ (၁)စုံ"];
    //$("#mtl").asuggest(suggests);

</script>
@endpush
