<template>
  <div class="signup-container">
    <div class="signup-content">
      <aside class="signup-image-container">
        <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/b0181e9bc8d03d388b3d54bb666a72e655bf00dd6785b81910a9eb4c18dba411?apiKey=8a1ef934bc6f454db56d3e8a4bd1613c" alt="Signup illustration" class="signup-image" />
      </aside>
      <main class="signup-form-container">
        <form class="signup-form" @submit.prevent="register">
          <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/38c412ea277b59864db3cd4ed6a2d11a4c6887cadace8315a82a5e8fa3de3251?apiKey=8a1ef934bc6f454db56d3e8a4bd1613c" alt="Company logo" class="company-logo" />
          <h1 class="signup-title">Sign Up 🧑‍💻</h1>
          <div class="form-group">
            <label for="name" class="form-label">Your Name*</label>
            <input type="text" id="name" class="form-input" v-model="name" placeholder="Michel Doe" required />
          </div>
          <div class="form-group">
            <label for="email" class="form-label">Your Email*</label>
            <input type="email" id="email" class="form-input" v-model="email" placeholder="youremail@example.com" required />
          </div>
          <div class="form-group">
            <label for="password" class="form-label">Create Password*</label>
            <input type="password" id="password" class="form-input" v-model="password" placeholder="Password" required />
          </div>
          <div class="form-group">
            <label for="whatsapp" class="form-label">WhatsApp Number</label>
            <input type="tel" id="whatsapp" class="form-input" v-model="whatsapp" placeholder="0852xxxxxxxx" />
          </div>
          <button type="submit" class="signup-button">Sign Up</button>
          <div class="login-link">
            <span>Already Have an account ?</span>
            <router-link to="/signin" class="login-text">Log In here</router-link>
          </div>
        </form>
      </main>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      name: '',
      email: '',
      password: '',
      whatsapp: ''
    };
  },
  methods: {
    register() {
      const userData = {
        name: this.name,
        email: this.email,
        password: this.password,
        contact: this.whatsapp
      };

      axios.post('http://127.0.0.1:8000/api/users', userData, {
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        }
      })
        .then(response => {
          console.log('User registered successfully:', response.data);
          this.$router.push('/signin');
        })
        .catch(error => {
          console.error('There was an error registering the user:', error.response.data);
          alert('Error: ' + error.response.data.message || 'There was an error registering the user.');
        });
    }
  }
};
</script>

<style scoped>
/* CSS styles remain the same */
.signup-container {
  background-color: #fff;
  display: flex;
  flex-direction: column;
  margin-left: 5%;
  margin-right: 5%;
}

.signup-content {
  display: flex;
}

.signup-image-container {
  width: 600px;
  background: linear-gradient(143deg, #212529 53.74%, #73818f 81.86%);
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 80px 60px;
}

.signup-image {
  aspect-ratio: 0.93;
  object-fit: auto;
  object-position: center;
  width: 392px;
  margin-top: 222px;
  max-width: 100%;
}

.signup-form-container {
  object-position: right;
  width: auto;
  display: flex;
  flex-direction: column;
  justify-content: center;
  padding: 0 20px;
}

.signup-form {
  display: flex;
  flex-direction: column;
  font-size: 20px;
  color: #212529;
  line-height: 1.4;
}

.company-logo {
  width: 100px;
  max-width: 100%;
  aspect-ratio: 2;
  object-fit: auto;
  object-position: center;
}

.signup-title {
  margin-top: 15px;
  font: 700 48px/1.1 Inter, sans-serif;
}

.form-group {
  margin-top: 21px;
}

.form-label {
  display: block;
  font-family: Inter, sans-serif;
  font-weight: 700;
  line-height: 1.26;
  margin-bottom: 10px;
}

.form-input {
  width: 100%;
  font-family: Inter, sans-serif;
  border: 1px solid #212529;
  border-radius: 5px;
  background-color: #fff;
  padding: 20px 24px;
  font-size: 16px;
  color: rgba(0, 0, 0, 0.5);
}

.signup-button {
  font-family: Inter, sans-serif;
  border-radius: 10px;
  background-color: #212529;
  margin-top: 40px;
  color: #fff;
  font-weight: 600;
  text-align: center;
  line-height: 1.76;
  padding: 26px 60px;
  border: none;
  cursor: pointer;
}

.login-link {
  display: flex;
  margin-top: 23px;
  gap: 11px;
  font-family: Inter, sans-serif;
}

.login-text {
  font-weight: 700;
  color: #212529;
  text-decoration: none;
}

@media (max-width: 991px) {
  .signup-content {
    flex-direction: column;
    align-items: stretch;
    gap: 0;
  }

  .signup-image-container {
    width: 100%;
    max-width: 100%;
    margin-top: 40px;
    padding: 0 20px;
  }

  .signup-image {
    margin-top: 40px;
  }

  .signup-form-container {
    width: 100%;
    margin-top: 40px;
  }

  .signup-title {
    font-size: 40px;
  }

  .form-input,
  .signup-button {
    padding: 20px;
  }

  .login-link {
    flex-wrap: wrap;
    margin-right: 6px;
  }
}
</style>
