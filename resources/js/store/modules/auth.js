import axios from 'axios'
import Cookies from 'js-cookie'
import * as types from '../mutation-types'

// state
export const state = {
  user: null,
  userInfo: [],
  questions: [],
  assessmentResult: [],
  token: Cookies.get('token'),
}

// getters
export const getters = {
  user: state => state.user,
  token: state => state.token,
  check: state => state.user !== null,
  userInfo: state => state.userInfo,
  questions: state => state.questions,
  assessmentResult: state => state.assessmentResult,

}

// mutations
export const mutations = {
  [types.SAVE_TOKEN] (state, { token, remember }) {
    state.token = token
    Cookies.set('token', token, { expires: remember ? 365 : null })
  },

  [types.FETCH_USER_SUCCESS] (state, { user }) {
    state.user = user
  },

  [types.FETCH_USERINFO] (state, { userInfo }) {
    state.userInfo = userInfo
  },

  [types.FETCH_QUESTIONS] (state, { questions }) {
    state.questions = questions
  },

  [types.FETCH_RESULT] (state, { assessmentResult }) {
    state.assessmentResult = assessmentResult
  },

  [types.FETCH_USER_FAILURE] (state) {
    state.token = null
    Cookies.remove('token')
  },

  [types.LOGOUT] (state) {
    state.user = null
    state.token = null

    Cookies.remove('token')
  },

  [types.UPDATE_USER] (state, { user }) {
    state.user = user
  },

  [types.UPDATE_USERINFO] (state, { userInfo }) {
    state.userInfo = userInfo
  },

  [types.UPDATE_QUESTIONS] (state, { questions }) {
    state.questions = questions
  },

  [types.UPDATE_RESULT] (state, { assessmentResult }) {
    state.assessmentResult = assessmentResult
  },
}

// actions
export const actions = {
  saveToken ({ commit, dispatch }, payload) {
    commit(types.SAVE_TOKEN, payload)
  },

  async fetchUser ({ commit }) {
    try {
      const { data } = await axios.get('/api/user')
     
        commit(types.FETCH_USER_SUCCESS, { user: data })
  
    
      //console.log({data});
    } catch (e) {
      commit(types.FETCH_USER_FAILURE)
    }
  },

  async fetchUserInfo ({ commit }) {
    try {
     
        const { data } = await axios.get('/api/form-resident')
      if({ data } ) {
        //console.log({data});
        commit(types.FETCH_USERINFO, { userInfo: data })
      }
     
      //console.log({data});
    } catch (e) {
      commit(types.ERROR)
    }
  },

  async fetchQuestions ({ commit }) {
    try {
      const { data } = await axios.get('/api/form-1')
    console.log({data});
    commit(types.FETCH_QUESTIONS, { questions: data })
    } catch (e) {
      commit(types.FETCH_QUESTIONS)
    }
  },

  async fetchAssessmentResult ({ commit }) {
    try {
      const { data } = await axios.get('/api/form-1/result')
    console.log({data});
    commit(types.FETCH_RESULT, {assessmentResult: data })
    } catch (e) {
      commit(types.FETCH_RESULT)
    }
  },

  updateUser ({ commit }, payload) {
    commit(types.UPDATE_USER, payload)
  },

  updateUserInfo ({ commit }, payload) {
    commit(types.UPDATE_USERINFO, payload)
  },

  updateQuestions ({ commit }, payload) {
    commit(types.UPDATE_QUESTIONS, payload)
  },

  updateAssessmentResult ({ commit }, payload) {
    commit(types.UPDATE_RESULT, payload)
  },


  async logout ({ commit }) {
    try {
      await axios.post('/api/logout')
    } catch (e) { }

    commit(types.LOGOUT)
  },

  async fetchOauthUrl (ctx, { provider }) {
    const { data } = await axios.post(`/api/oauth/${provider}`)

    return data.url
  }
}
