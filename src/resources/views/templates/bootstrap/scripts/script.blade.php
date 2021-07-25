<script>
    function ShopyService(){
        const miniCart = document.getElementById('mini-cart');
        const cartBadge = document.querySelector('.cart_badge');

        this.showMiniCart = function(){
            miniCart.classList.add('active');
            cartBadge.classList.add('active');
        }

        this.hideMiniCart = function(){
            miniCart.classList.remove('active');
            cartBadge.classList.remove('active');
        }
        
        this.addProduct = function(formId, options){
            if(window.innerWidth < 720) return true;
            const form = typeof formId === 'string' ? (document.getElementById(formId) ? document.getElementById(formId) : document.querySelector(formId)) : (formId instanceof HTMLFormElement ? formId : null);
            if(!form) return true;
            const r = new XMLHttpRequest(), fd = new FormData(form);
            r.onload = () => {
                if(r.readyState === 4){
                    if(r.status === 200){
                        const res = JSON.parse(r.responseText);
                        if(res.status){
                            miniCart.innerHTML = res.content;
                            const b = document.querySelector('.cart_badge div.tip');
                            b && (b.innerHTML = res.cart.total);
                            this.showMiniCart();
                            setTimeout(() => {
                                this.hideMiniCart();
                            }, 3000);
                        }
                        else{
                            alert(res.message);
                        }
                    }
                }
            }
            r.onerror = (er) => {

            }
            r.open('POST', form.action);
            r.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            r.send(fd);

            return false;
        }
    }

    var Shopy = null;
    window.addEventListener('load', () => {
        Shopy = new ShopyService();
    })
</script>