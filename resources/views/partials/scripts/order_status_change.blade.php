<script>
    $('.status').click(function () {
        let status = $(this).attr('data-status');
        let id = $(this).attr('data-id');
        let update_status;
        let choice = false;
        if(status === 'PLACED'){
            choice = confirm('Do you want to cancel this order?');
            update_status = 'CANCELED';
        }
        if(status === 'WAY'){
            choice = confirm('Did you Received this order?');
            update_status = 'DELIVERED';
        }
        if(choice){
            axios.put('/order/'+id,{
                status: update_status
            }).then(function (response) {
                if(response.data && response.data === 'Updated'){
                    location.reload();
                }else{
                    alert('Sorry!! your request could\'nt be processed right now');
                }
            }).catch(function (error) {
                console.log(error)
            })
        }
    })
</script>
