 <!--     Fonts and icons     -->
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<!-- CSS Files -->
<link href="{{ asset('assets') }}/css/bootstrap.min.css" rel="stylesheet" />
<link href="{{ asset('assets') }}/css/now-ui-dashboard.css?v=1.3.0" rel="stylesheet" />
<!-- CSS Just for demo purpose, don't include it in your project -->
<link href="{{ asset('assets') }}/demo/demo.css" rel="stylesheet" />
<!-- Data Tables -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<!-- Toastr -->
<link href="{{ asset('/componentes/toastr/css/toastr.min.css') }}" rel="stylesheet">
<script>
  // Facebook Pixel Code Don't Delete
  ! function(f, b, e, v, n, t, s) {
    if (f.fbq) return;
    n = f.fbq = function() {
      n.callMethod ?
        n.callMethod.apply(n, arguments) : n.queue.push(arguments)
    };
    if (!f._fbq) f._fbq = n;
    n.push = n;
    n.loaded = !0;
    n.version = '2.0';
    n.queue = [];
    t = b.createElement(e);
    t.async = !0;
    t.src = v;
    s = b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t, s)
  }(window,
    document, 'script', '//connect.facebook.net/en_US/fbevents.js');
  try {
    fbq('init', '111649226022273');
    fbq('track', "PageView");
  } catch (err) {
    console.log('Facebook Track Error:', err);
  }
</script>
<style>
  .required{
    color: red;
  }
  .form-error{
    font-size: 0.8em;
  }

  .subtitulo-nav{ 
    font-size: 1em;
    margin: 20px 20px;
    padding: 0.7rem;
    color: #FFFFFF;
    line-height: 20px;
  }
  .subtitulo-div{
    margin-top: 20px;
    position: relative;
    z-index: 4;
  }
</style>