function page (path) {
  return () => import(/* webpackChunkName: '' */ `~/pages/${path}`).then(m => m.default || m)
}

export default [
  { path: '/', name: 'welcome', component: page('welcome.vue') },
  { path: '/home', name: 'home', component: page('home.vue') },
  { path: '/about', name: 'about', component: page('about.vue') },
  { path: '/consent', name: 'consent', component: page('consent.vue') },
  { path: '/login', name: 'login', component: page('auth/login.vue') },
  { path: '/register', name: 'register', component: page('auth/register.vue') },
  { path: '/password/reset', name: 'password.request', component: page('auth/password/email.vue') },
  { path: '/password/reset/:token', name: 'password.reset', component: page('auth/password/reset.vue') },
  { path: '/email/verify/:id', name: 'verification.verify', component: page('auth/verification/verify.vue') },
  { path: '/email/resend', name: 'verification.resend', component: page('auth/verification/resend.vue') },

  { path: '/settings', component: page('settings/index.vue'),
    children: [
      { path: '', redirect: { name: 'settings.profile' } },
      { path: 'profile', name: 'settings.profile', component: page('settings/profile.vue') },
      { path: 'password', name: 'settings.password', component: page('settings/password.vue') },
      { path: 'questionaire', name: 'settings.questionaire', component: page('settings/questionaire.vue') }
    ] 
  },

  { path: '/assessment', component: page('assessment/index.vue'),
    children: [
      { path: '', redirect: { name: 'assessment.consent' } },
      { path: 'consent', name: 'assessment.consent', component: page('assessment/consent.vue') },
      { path: 'form-resident', name: 'assessment.form-resident', component: page('assessment/form-resident.vue') },
      { path: 'confirm-identity', name: 'assessment.confirm-identity', component: page('assessment/confirm-identity.vue') },
      { path: 'form-1', name: 'assessment.form-1', component: page('assessment/form-1.vue') },
    ] 
  },

  { path: '*', component: page('errors/404.vue') }
]
