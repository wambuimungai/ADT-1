<script>
 $(document).ready(function() {
         
        
        $('.faq_question').click(function() {
 
        if ($(this).parent().is('.open')){
            $(this).closest('.faq').find('.faq_answer_container').animate({'height':'0'},500);
            $(this).closest('.faq').removeClass('open');
 
            }else{
                var newHeight =$(this).closest('.faq').find('.faq_answer').height() +'px';
                $(this).closest('.faq').find('.faq_answer_container').animate({'height':newHeight},500);
                $(this).closest('.faq').addClass('open');
            }
 
    });
 
});
</script>
<style>
/*FAQS*/
.faq_question {
    margin: 0px;
    padding: 0px 0px 5px 0px;
    display: inline-block;
    cursor: pointer;
    font-weight: bold;
}
 
.faq_answer_container {
    height: 0px;
    overflow: hidden;
    padding: 0px;
}
 
</style>


<div class="full-content">
    <div class="row-fluid">
       <div class="span10 offset1">
           <div class="faq_container">
   <div class="faq">
       <div class="faq_header">
           <h3>Module</h3>
       </div>
      <div class="faq_question">Question goes here</div>
           <div class="faq_answer_container">
              <div class="faq_answer">Answer goes here</div>
           </div>        
    </div>
      
 </div>
       	</div>
	</div>
</div>


