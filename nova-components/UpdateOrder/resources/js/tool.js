Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'UpdateOrder',
      path: '/UpdateOrder',
      component: require('./components/Tool'),
    },
  ])
})
