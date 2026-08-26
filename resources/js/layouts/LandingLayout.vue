<script setup lang="ts">
import Footer from '@/landing/components/Footer.vue';
import Navbar from '@/landing/components/Navbar.vue';
</script>

<template>
    <div class="landing-wrapper">
        <Navbar />
        <slot />
        <Footer />
    </div>
</template>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

.landing-wrapper {
    font-family: 'poppins', 'sans-serif';
    background: #0d0d12;
    min-height: 100vh;
    overflow-x: hidden;
}

.landing-wrapper header {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    padding: 0 60px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    z-index: 100;
    height: 70px;
    background: transparent;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    transition: background 0.3s ease, padding 0.3s ease;
}

.landing-wrapper header.scrolled {
    background: rgba(13, 13, 18, 0.85);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border-bottom-color: rgba(255, 255, 255, 0.06);
}

.landing-wrapper .logo {
    font-size: 1.4em;
    color: #ffffff;
    font-weight: 600;
    letter-spacing: -0.5px;
}

.landing-wrapper .logo span {
    color: #a78bfa;
}

.landing-wrapper .navigation {
    display: flex;
    gap: 2px;
}

.landing-wrapper .navigation a {
    text-decoration: none;
    color: rgba(255, 255, 255, 0.7);
    padding: 8px 18px;
    font-weight: 400;
    font-size: 0.9em;
    border-radius: 8px;
    transition: color 0.3s ease, background 0.3s ease;
    position: relative;
}

.landing-wrapper .navigation a:hover {
    color: #ffffff;
    background: rgba(255, 255, 255, 0.08);
}

.landing-wrapper .navigation a.active {
    color: #ffffff;
}

.landing-wrapper .navigation a.active::after {
    content: '';
    position: absolute;
    bottom: 4px;
    left: 50%;
    transform: translateX(-50%);
    width: 16px;
    height: 2px;
    background: #a78bfa;
    border-radius: 2px;
}

.landing-wrapper .login-btn {
    border: 1px solid rgba(167, 139, 250, 0.4) !important;
    color: #a78bfa !important;
    margin-left: 8px;
}

.landing-wrapper .navigation a.login-btn:hover {
    background: #a78bfa !important;
    color: #ffffff !important;
    border-color: #a78bfa !important;
}

.landing-wrapper .menu-toggle {
    display: none;
    flex-direction: column;
    gap: 5px;
    background: none;
    border: none;
    cursor: pointer;
    padding: 8px;
}

.landing-wrapper .menu-toggle span {
    display: block;
    width: 22px;
    height: 2px;
    background: #ffffff;
    border-radius: 2px;
    transition: transform 0.3s ease, opacity 0.3s ease;
}

.landing-wrapper .menu-toggle.open span:nth-child(1) {
    transform: translateY(7px) rotate(45deg);
}

.landing-wrapper .menu-toggle.open span:nth-child(2) {
    opacity: 0;
}

.landing-wrapper .menu-toggle.open span:nth-child(3) {
    transform: translateY(-7px) rotate(-45deg);
}

@media (max-width: 768px) {
    .landing-wrapper header {
        padding: 0 24px;
    }

    .landing-wrapper .navigation {
        position: fixed;
        top: 70px;
        left: 0;
        width: 100%;
        flex-direction: column;
        background: rgba(13, 13, 18, 0.95);
        backdrop-filter: blur(12px);
        padding: 16px 24px;
        gap: 4px;
        transform: translateY(-110%);
        opacity: 0;
        transition: transform 0.3s ease, opacity 0.3s ease;
        border-bottom: 1px solid rgba(255, 255, 255, 0.06);
    }

    .landing-wrapper .navigation.open {
        transform: translateY(0);
        opacity: 1;
    }

    .landing-wrapper .navigation a {
        padding: 12px 16px;
        font-size: 1em;
    }

    .landing-wrapper .navigation a.active::after {
        bottom: 8px;
    }

    .landing-wrapper .menu-toggle {
        display: flex;
    }
}
</style>
