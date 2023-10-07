@if (session('success'))
     flash()->addSuccess({{ session('success') }});  
@endif
@if (session('error'))
    flash()->addError({{ session('error') }});
@endif
@if (session('warning'))
    flash()->addWarning({{ session('error') }});
@endif