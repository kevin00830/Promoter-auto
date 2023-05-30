
<style>
    .mega-menu-mod{
        margin-top: 12px;
        /* padding: 98px; */
    }
    #modal-header{
        padding: 41px;
    }
    #main-header-links .row div .box {
        text-align: center;
        line-height: 54px;
        margin-bottom: 16px;
        background: #f96116;
        width: 100%;
    }
    #main-header-links div a{
        color:  #ffffff;
        text-decoration: none
    }
    .modal-dialog {
        max-width: 100% !important;
        margin: 1.75rem auto;
    }
    .close {
    position: absolute;
    right: 21px;
    border: none;
    border-radius: 45px;
    height: 30px;
    font-size: 20px;
    /* line-height: 16px; */
    background: no-repeat;
    /* width: 30px; */
}
</style>


<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
<!-- End Header -->


<!-- The Modal -->
<div class="modal p-0" id="myModal_menu">
<div class="modal-dialog" id="modal-header">
    <div class="modal-content mega-menu-mod">
        
        <!-- Modal body -->
        <div class="modal-body">
            <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
            <center><a href="https://notifire-api.com/"><img alt="Logo" src="{{ asset('images') }}/logo_cdsol_trans.png" class="" width="20%" /></a></center><br><br>
            <div class="container-fluid pl-5 pr-5" id="main-header-links">
                <div class="row">
                    <?php 
                        $modal_link = DB::table('modals')->get();
                        $url_ = Request::segment(1);
                    ?>
                    @foreach($modal_link as $val)
                    <div class="col-md-4 col-sm-6 mb-8"><div class="box"><a href="<?= $val->link ?>"><?= ($url_ == 'en') ? $val->en_title : $val->pt_title ?></a></div></div>
                    @endforeach
                </div>
            </div>
            
        </div>
        
    </div>
</div>
</div>

<script>
    function get_moadal(){
        $('#myModal_menu').modal('show');
    }
</script>

