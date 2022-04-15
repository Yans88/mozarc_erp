@extends('pages.settings.ajaxwrapper')
@section('settings-page')
<!--settings-->
<form class="form">
    <!--form text tem-->
    <div class="form-group row">
        <label class="col-12 control-label col-form-label">{{ cleanLang(__('lang.estimate_prefix')) }}</label>
        <div class="col-12">
            <input type="text" class="form-control form-control-sm" id="settings_estimates_prefix"
                name="settings_estimates_prefix" value="{{ $settings->settings_estimates_prefix ?? '' }}">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-12 col-form-label">{{ cleanLang(__('lang.terms_and_conditions')) }}</label>
        <div class="col-12 p-t-5">
                <textarea class="form-control form-control-sm tinymce-textarea" rows="5" name="settings_estimates_default_terms_conditions" id="settings_estimates_default_terms_conditions">
                    {{ $settings->settings_estimates_default_terms_conditions ?? '' }}
                </textarea>
        </div>
    </div>

    
    <!--form checkbox item-->
    <div class="form-group form-group-checkbox row">
        <div class="col-12 p-t-5">
            <input type="checkbox" id="settings_estimates_show_view_status"
                name="settings_estimates_show_view_status" class="filled-in chk-col-light-blue"
                {{ runtimePrechecked($settings['settings_estimates_show_view_status'] ?? '') }}>
            <label for="settings_estimates_show_view_status">{{ cleanLang(__('lang.show_if_client_has_opened')) }}</label>
        </div>
    </div>

    
    <!--buttons-->
    <div class="text-right">
        <button type="submit" id="commonModalSubmitButton" class="btn btn-rounded-x btn-danger waves-effect text-left js-ajax-ux-request"
            data-url="/settings/estimates" data-loading-target="" data-ajax-type="PUT" data-type="form"
            data-on-start-submit-button="disable">{{ cleanLang(__('lang.save_changes')) }}</button>
    </div>
</form>
@endsection