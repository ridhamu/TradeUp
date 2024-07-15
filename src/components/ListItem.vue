<template>
    <div class="landing-page">
        <header class="header">
            <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/38c412ea277b59864db3cd4ed6a2d11a4c6887cadace8315a82a5e8fa3de3251?apiKey=8a1ef934bc6f454db56d3e8a4bd1613c" alt="TradeUp Logo" class="logo" />
            <nav class="navigation">
                <a href="#" class="nav-link">home</a>
                <a href="#" class="nav-link">search</a>
                <a href="#" class="nav-link">post</a>
                <a href="#" class="nav-link">saved</a>
                <a href="#" class="nav-button">Register</a>
            </nav>
        </header>

        <main>
            <section class="hero">
                <div class="hero-content">
                    <h1 class="hero-title">TradeUp: Where Second-Hand Means First-Rate 🥇</h1>
                    <p class="hero-description">Curated collections of high-quality used items waiting just for you.</p>
                    <a href="#" class="cta-button">Search Now 🔍</a>
                </div>
                <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/86373e67be7a9b3bb017f02ce6c6d0762aa6f89a5c999287e9c1182ae13fa288?apiKey=8a1ef934bc6f454db56d3e8a4bd1613c" alt="TradeUp Hero Image" class="hero-image" />
            </section>

            <section class="items-grid">
                <article v-for="product in products" :key="product.id" class="item-card">
                    <div class="item-image">
                        <img v-if="product.image_url" :src="product.image_url" alt="Product Image" class="item-img">
                        <span v-else>No Image</span>
                    </div>
                    <div class="item-content">
                        <h2 class="item-title">{{ product.name }}</h2>
                        <p class="item-description">{{ product.description }}</p>
                        <div class="read-more-wrapper">
                            <a href="#" class="read-more-link">Read More</a>
                            <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/a32fb2b6bf9f6790ef6ce7cba23fd9ca84dd05d5982c0cb79755ed0757267cc4?apiKey=8a1ef934bc6f454db56d3e8a4bd1613c" alt="" class="read-more-icon" />
                        </div>
                    </div>
                </article>
            </section>
        </main>

        <footer class="footer">
            <div class="footer-divider"></div>
            <div class="footer-content">
                <div class="footer-branding">
                    <div class="footer-logos">
                        <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/7a5563af980893648fb2013f52c5eca8378fd390d23795610701bb72f3d44131?apiKey=8a1ef934bc6f454db56d3e8a4bd1613c" alt="TradeUp Logo 1" class="footer-logo" />
                        <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/7f79a97c34d37e0b23d1dc154296e08699a2c492ef6a8fd7591f2763b0f2624b?apiKey=8a1ef934bc6f454db56d3e8a4bd1613c" alt="TradeUp Logo 2" class="footer-logo" />
                    </div>
                    <p class="copyright">©️ 2024</p>
                </div>
                <div class="footer-links">
                    <div class="footer-column">
                        <h3 class="footer-heading">Product</h3>
                        <a href="#" class="footer-link">Footer Item 1</a>
                        <a href="#" class="footer-link">Footer Item 2</a>
                        <a href="#" class="footer-link">Footer Item 3</a>
                    </div>
                    <div class="footer-column">
                        <h3 class="footer-heading">Company</h3>
                        <a href="#" class="footer-link">Footer Item 1</a>
                        <a href="#" class="footer-link">Footer Item 2</a>
                        <a href="#" class="footer-link">Footer Item 3</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            products: []
        }
    },

    mounted() {
        axios.get('http://127.0.0.1:8000/api/products')
            .then(response => {
                this.products = response.data.data;
            })
            .catch(error => {
                console.error('Error fetching products:', error);
            });
    }
};
</script>

<style scoped>
 .landing-page {
    background-color: #fff;
    display: flex;
    flex-direction: column;
    margin-left: 5%;
    margin-right: 5%;
  }
  
  .header {
    border-bottom: 1px solid rgba(33, 37, 41, 0.8);
    background-color: #fff;
    display: flex;
    width: auto;
    gap: 20px;
    font-size: 32px;
    color: #212529;
    font-weight: 500;
    justify-content: space-between;
    padding: 26px 28px 26px 64px;
  }
  
  .logo {
    aspect-ratio: 2;
    object-fit: auto;
    object-position: center;
    width: 100px;
    max-width: 100%;
    margin: auto 0;
  }
  
  .navigation {
    display: flex;
    align-items: center;
    gap: 20px;
  }
  
  .nav-link {
    font-family: Inter, sans-serif;
    text-decoration-line: underline;
    align-self: stretch;
    margin: auto 0;
  }
  
  .nav-button {
    font-family: Inter, sans-serif;
    border-radius: 10px;
    border: 2px solid rgba(33, 37, 41, 1);
    align-self: stretch;
    font-weight: 700;
    padding: 19px 35px;
  }
  
  .hero {
    align-self: center;
    margin-top: 119px;
    width: auto;
    display: flex;
    gap: 20px;
  }
  
  .hero-content {
    display: flex;
    margin-top: 10px;
    flex-grow: 1;
    flex-direction: column;
    color: #212529;
    font-weight: 700;
    line-height: 110%;
    padding: 0 20px;
  }
  
  .hero-title {
    font: 56px/62px Inter, sans-serif;
  }
  
  .hero-description {
    margin-top: 50px;
    font: 600 20px Inter, sans-serif;
  }
  
  .cta-button {
    border-radius: 10px;
    border: 2px solid rgba(33, 37, 41, 1);
    align-self: start;
    margin-top: 40px;
    text-align: center;
    padding: 19px 46px;
    font: 32px Inter, sans-serif;
  }
  
  .hero-image {
    aspect-ratio: 1.06;
    object-fit: auto;
    object-position: right;
    width: 100%;
    flex-grow: 1;
  }
  
  .features {
    align-self: center;
    display: flex;
    margin-top: 120px;
    width: auto;
    align-items: start;
    gap: 20px;
    justify-content: space-between;
  }
  
  .features-image-wrapper {
    border-radius: 8px;
    background: linear-gradient(131deg, #212529 0.41%, #73818f 99.59%);
    display: flex;
    flex-direction: column;
    align-items: end;
    padding: 51px 60px 0;
  }
  
  .features-image {
    aspect-ratio: 1.06;
    object-fit: auto;
    object-position: center;
    width: 100%;
    border: 1px solid rgba(33, 37, 41, 1);
  }
  
  .features-content {
    align-self: stretch;
    display: flex;
    flex-grow: 1;
    flex-direction: column;
    gap: 20px;
    color: #212529;
    font-weight: 700;
    line-height: 110%;
    font: 32px/36px Inter, sans-serif;
  }
  
  .search-section {
    padding: 50px 0;
    display: flex;
    justify-content: center;
  }
  
  .search-container {
    display: flex;
    flex-direction: column;
    gap: 20px;
    width: 100%;
  }
  
  .search-input-wrapper {
    display: flex;
    flex-direction: column;
  }
  
  .search-label {
    font-weight: bold;
    margin-bottom: 10px;
  }
  
  .search-input {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
  }
  
  .category-search-wrapper {
    display: flex;
    gap: 20px;
  }
  
  .category-dropdown {
    display: flex;
    flex-direction: column;
  }
  
  .category-label {
    font-weight: bold;
    margin-bottom: 10px;
  }
  
  .select-wrapper {
    position: relative;
  }
  
  .category-select {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
  }
  
  .dropdown-icon {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
  }
  
  .search-button {
    padding: 10px 20px;
    background-color: #212529;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }
  
  .items-grid {
    display: grid;
    gap: 20px;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    padding: 50px 0;
  }
  
  .item-card {
    border: 1px solid #ccc;
    border-radius: 5px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
  }
  
  .item-image {
    background-color: #f0f0f0;
    height: 200px;
  }
  
  .item-content {
    padding: 20px;
    display: flex;
    flex-direction: column;
    gap: 10px;
  }
  
  .item-title {
    font-weight: bold;
    font-size: 20px;
  }
  
  .item-description {
    flex-grow: 1;
  }
  
  .read-more-wrapper {
    display: flex;
    align-items: center;
    gap: 10px;
  }
  
  .read-more-link {
    color: #007bff;
    text-decoration: none;
  }
  
  .read-more-icon {
    width: 16px;
    height: 16px;
  }
  
  .footer {
    display: flex;
    flex-direction: column;
    padding-top: 50px;
  }
  
  .footer-divider {
    border-top: 2px solid #d9d9d9;
  }
  
  .footer-content {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    padding: 20px 0;
  }
  
  .footer-branding {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
    flex-grow: 1;
  }
  
  .footer-logos {
    display: flex;
    gap: 10px;
  }
  
  .footer-logo {
    width: 50px;
    height: 50px;
  }
  
  .footer-links {
    display: flex;
    gap: 20px;
    flex-grow: 2;
  }
  
  .footer-column {
    display: flex;
    flex-direction: column;
    gap: 10px;
  }
  
  .footer-heading {
    font-weight: bold;
  }
  
  .footer-link {
    text-decoration: none;
    color: #212529;
  }
</style>