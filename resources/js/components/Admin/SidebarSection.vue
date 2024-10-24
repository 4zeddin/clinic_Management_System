<template>
  <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
      <a class="sidebar-brand brand-logo" href="index.html">
        <h3 class="text-white font-bold"><span class="text-success">One</span>-Health</h3>
      </a>
      <a class="sidebar-brand brand-logo-mini" href="index.html">
        <h3 class="font-bold text-white"><span class="text-success">O</span>-H</h3>
      </a>
    </div>
    <ul class="nav">
      <li class="nav-item profile">
        <div class="profile-desc">
          <div class="profile-pic">
            <div class="count-indicator">
              <img loading="lazy" class="img-xs rounded-circle" :src="userProfilePic" alt="">
              <span class="count bg-success"></span>
            </div>
            <div class="profile-name">
              <h5 class="mb-0 font-weight-normal">{{ userName }}</h5>
              <span>Admin Member</span>
            </div>
          </div>
        </div>
      </li>
      <li class="nav-item nav-category">
        <span class="nav-link">Navigation</span>
      </li>
      <li class="nav-item menu-items" v-for="item in menuItems" :key="item.route">
        <router-link class="nav-link" :to="item.route">
          <span class="menu-icon">
            <i :class="item.icon"></i>
          </span>
          <span class="menu-title">{{ item.title }}</span>
        </router-link>
      </li>
    </ul>
  </nav>
</template>

<script>
export default {
  props: {
    userName: {
      type: String,
      required: true
    },
    userProfilePic: {
      type: String,
      required: true
    },
    menuItems: {
      type: Array,
      required: true
    }
  }
}
</script>


