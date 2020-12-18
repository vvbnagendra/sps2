<section class="page-breadcumb-area bg-with-black">
    <div class="container text-center">
        <h2 class="title"><?php echo $this->lang->line('online_admission'); ?></h2>
        <ul class="links">
            <li><a href="<?php echo site_url(); ?>"><?php echo $this->lang->line('home'); ?></a></li>
            <li><a href="javascript:void(0);"><?php echo $this->lang->line('online_admission'); ?></a></li>
        </ul>
    </div>
</section>
<section>
    <div class="container text-center">        
        <?php $this->load->view('layout/message'); ?> 
    </div>
</section>

<section class="page-contact-area">
    <div class="container">
       <iframe src="https://docs.google.com/forms/d/e/1FAIpQLScmhBCZpw-1bVFvfwkSJw6g-Na7tByFwjyc5QaO5fxRtzNCxA/viewform?embedded=true" width="450" height="1000" frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe>
    </div>
</section>
<link href="<?php echo VENDOR_URL; ?>datepicker/datepicker.css" rel="stylesheet">
 <script src="<?php echo VENDOR_URL; ?>datepicker/datepicker.js"></script>
 <script type="text/javascript">     
     
    $('#dob').datepicker({ startView: 2 });
    $('#admission').validate();
    
        
    function check_guardian_type(guardian_type){

         $('#relation_with').val('');  
         $('#gud_name').val('');  
         $('#gud_phone').val('');  
         $('#gud_present_address').val('');  
         $('#gud_permanent_address').val('');  
         $('#gud_religion').val(''); 
         $('#gud_profession').val(''); 
         $('#gud_national_id').val(''); 
         $('#gud_email').val(''); 
         $('#gud_other_info').val(''); 

        if(guardian_type == 'father'){

            $('#relation_with').val('<?php echo $this->lang->line('father'); ?>'); 
            $('.fn_existing_guardian').hide();
            $('.fn_except_exist').show();                          
            $('#gud_name').prop('required', true);               
            $('#gud_phone').prop('required', true);               
            $('#gud_email').prop('required', true);               

            var f_name = $('#father_name').val();
            var f_phone = $('#father_phone').val(); 
            var f_profession = $('#father_profession').val(); 

            $('#gud_name').val(f_name);  
            $('#gud_phone').val(f_phone); 
            $('#gud_profession').val(f_profession); 

        }else if(guardian_type == 'mother'){

            $('#relation_with').val('<?php echo $this->lang->line('mother'); ?>');   
            $('.fn_existing_guardian').hide();
            $('.fn_except_exist').show();            
            $('#gud_name').prop('required', true);               
            $('#gud_phone').prop('required', true);               
            $('#gud_email').prop('required', true); 

            var m_name = $('#mother_name').val();
            var m_phone = $('#mother_phone').val(); 
            var m_profession = $('#mother_profession').val(); 

            $('#gud_name').val(m_name);  
            $('#gud_phone').val(m_phone); 
            $('#gud_profession').val(m_profession); 

        }else if(guardian_type == 'other'){
            $('#relation_with').val('<?php echo $this->lang->line('other'); ?>');    
            $('.fn_existing_guardian').hide();
            $('.fn_except_exist').show();           
            $('#gud_name').prop('required', true);               
            $('#gud_phone').prop('required', true);               
            $('#gud_email').prop('required', true); 

        }else if(guardian_type == 'exist_guardian'){
            $('.fn_existing_guardian').show();
            $('.fn_except_exist').hide();            
            $('#gud_name').prop('required', false);               
            $('#gud_phone').prop('required', false);               
            $('#gud_email').prop('required', false); 

        }else{
             $('#relation_with').val('');   
             $('.fn_existing_guardian').hide();
             $('.fn_except_exist').show();             
             $('#gud_name').prop('required', true);               
             $('#gud_phone').prop('required', true);               
             $('#gud_email').prop('required', true); 
        }

     }
     
    $('#same_as_guardian').on('click', function(){
        
        if($(this).is(":checked")) {
            
            var present =  $('#gud_present_address').val();  
            var permanent = $('#gud_permanent_address').val(); 
            
            $('#present_address').val(present);  
            $('#permanent_address').val(permanent);  
        }else{
             $('#present_address').val('');  
             $('#permanent_address').val(''); 
        }
    });
        
         
    $('#fn_find').on('click', function(){
           
        var phone = $('#gud_phone').val();

        if(!phone){
            $('#gud_phone').focus();
            return false;
        }

        $.ajax({       
        type   : "POST",
        dataType: "json",
        url    : "<?php echo site_url('web/get_guardian_info'); ?>",
        data   : { phone : phone},               
        async  : true,
        success: function(response){ 
           if(response)
           {
                $('#guardian_id').val(response.id);  
                $('#gud_name').val(response.name);  
                $('#gud_email').val(response.email);  
                $('#gud_national_id').val(response.national_id);  
                $('#gud_profession').val(response.profession);  
                $('#gud_religion').val(response.religion);  
                $('#gud_present_address').val(response.present_address);  
                $('#gud_permanent_address').val(response.permanent_address); 
                $('#gud_phone').val(response.phone);                    

           }else{

                $('#guardian_id').val('');  
                $('#gud_name').val('');  
                $('#gud_email').val('');  
                $('#gud_national_id').val('');  
                $('#gud_profession').val('');  
                $('#gud_religion').val('');  
                $('#gud_present_address').val('');  
                $('#gud_permanent_address').val(''); 
                $('#gud_phone').val(''); 
                
                }
             }
         });  
     });
        
        
</script>
