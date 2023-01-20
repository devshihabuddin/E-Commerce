<!-- Javascript -->
<script src="{{asset('backend/assets/bundles/libscripts.bundle.js')}}"></script>    
<script src="{{asset('backend/assets/bundles/vendorscripts.bundle.js')}}"></script>
<script src="{{asset('backend/assets/bundles/jvectormap.bundle.js')}}"></script> <!-- JVectorMap Plugin Js -->
<script src="{{asset('backend/assets/bundles/morrisscripts.bundle.js')}}"></script><!-- Morris Plugin Js -->
<script src="{{asset('backend/assets/bundles/knob.bundle.js')}}"></script> <!-- Jquery Knob-->
<!-- font-wasome -->
<script defer src="https://pro.fontawesome.com/releases/v5.10.0/js/duotone.js" integrity="sha384-PcDzzpTJzDDda2YUM4EY5ZqnZQ3DTIFtoaAn7t07N0UIY1HVyaxIHRzROmFBd48z" crossorigin="anonymous"></script>
<script defer src="https://pro.fontawesome.com/releases/v5.10.0/js/fontawesome.js" integrity="sha384-8YSeMunSTZdDZy7rZxfG3NqC3KnYaCKxTJMm9yoILgIoMpXeTKDrV8TeV9C5ItEc" crossorigin="anonymous"></script>

<!-- //summernote -->
<script src="{{asset('backend/assets/summernote-0.8.18-dist/summernote.js')}}"></script>
<!-- switch button on jquery -->
<script src="{{asset('backend/assets/switch-button-bootstrap/src/bootstrap-switch-button.js')}}"></script>

<script src="{{asset('backend/assets/bundles/mainscripts.bundle.js')}}"></script>
<script src="{{asset('backend/assets/js/index3.js')}}"></script>
<script src="{{asset('backend/assets/bundles/datatablescripts.bundle.js')}}"></script>
<script src="{{asset('backend/assets/js/pages/tables/jquery-datatable.js')}}"></script>
@stack('js')

<!--session msg alert timeout -->
<script>
    setTimeout(function(){
        $('#alert').slideUp();
    },5000);
</script>
