<template>
    <div>
        <h6 class="text-uppercase text-secondary font-weight-bolder">Price Breakdown</h6>
        <div class="pt-2 pb-2 border-bottom border-top d-flex justify-content-between">
          <span>{{ price.breakdown.days_interval  }} X ${{ price.breakdown.bookable_price }}</span>  
          <span>{{ price.breakdown.days_interval*price.breakdown.bookable_price }}</span> 
        </div>
        <div class="font-weight-bolder d-flex justify-content-between">
            <span>Total</span> 
            <span>${{ price.total_booking_price }}</span>
        </div>
    </div>
</template>

<script>

export default {
    props: {
        price: Object
    }
}

</script>