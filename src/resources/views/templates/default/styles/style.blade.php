<style>
    /** MINI CART */
    .cart_badge{
        position: relative;
        width: 50px;
        text-align: center;
        height: 50px;
        border-radius: 100%;
        vertical-align: middle;
        display: inline-flex !important;
        align-items: center;
        justify-content: center;
    }
    .cart_badge.active::before{
        display: block;
        position: absolute;
        content: '';
        width: 50px;
        height: 50px;
        left: 0px;
        top: 0px;
        background: #ff000052;
        animation: cart-badge-animate 2s linear 0s 3 alternate;
        border-radius: 100%;
        opacity: 0;
    }
    .mini-card{
        position: absolute;
        right: -2px;
        top: 46px;
        width: 320px;
        background-color: #fff;
        z-index: 9;
        box-shadow: -2px 2px 32px rgba(0, 0, 0, 0.3);
        border-radius: 4px;
        padding: 16px;
        display: block;
        text-align: left;
        opacity: 0;
        pointer-events: none;
        transition-duration: 0.5s;
        transform: translateY(50px);
    }

    .cart_badge:hover .mini-card{
        opacity: 1;
        pointer-events: initial;
        transform: translateY(0px);
    }

    .mini-card.active{
        opacity: 1;
        pointer-events: initial;
        transform: translateY(0px);
    }
    .mini-card a.btn{
        color: #fff;
    }

    .mini-cart-item{
        display: flex;
        flex-direction: row; 
        margin-bottom: 8px;
        padding: 8px;
        border-radius: 4px;
    }

    .mini-cart-item.active{
        background-color: #adff2fb8;
    }
    @keyframes cart-badge-animate{
        0%{
            transform: scale(1);
            opacity: 0;
        }
        75%{
            transform: scale(1.5);
            opacity: 1;
        }
        100%{
            transform: scale(1);
            opacity: 0;
        }
    }

    @keyframes cart-fade-in{
        from{
            opacity: 0;
            transform: translateY(50px);
        }
        to{
            opacity: 1;
            transform: translateY(0px);
        }
    }
</style>