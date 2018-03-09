import Config from '../config/config';
import axios from 'axios';
import {errorPopup} from './error-popup';
import {getToken} from './get-token';

export function Login(logindata) {
  
  const errprep = logindata.auto ? 'Automatisk inlogging misslyckades! ' : '';

  return (dispatch) => {
    getToken('login')
      .then(response => {
        axios.post( Config.ApiUrl + '/auth', {
          user: logindata.user,
          pwd: logindata.pwd,
          apitoken: Config.ApiToken,
          logintoken: response.data.logintoken,
        })
          .then(response => {
            let payload = {
              login: false,
              autoAttempt: false,
            };         
            try {
              if (response.data.login !== undefined) {
                payload = {...payload, ...response.data};
              }
            } catch(e) {
              dispatch(errorPopup({visible: true, message: errprep + 'Okänt svar från API.'}));
            }
            dispatch({type: 'LOGIN', payload: payload});
            return Promise.resolve();
          })
          .catch(error => {
            let errormsg = errprep + 'Ett fel har uppstått i inloggningen.';
            try {
              if (error.response.data.response !== undefined) {
                errormsg = errprep + error.response.data.response;
              }
            } catch(e) {
              errormsg = errprep + 'Ett fel har uppstått i inloggningen. Felformaterat eller inget svar från API.';
            }
            dispatch(errorPopup({visible: true, message: errormsg}));
            dispatch({type: 'LOGIN', payload: {autoAttempt: false}});
            return Promise.reject();
          });
      })
      .catch(error => {
        let errormsg = errprep + 'Ett fel har uppstått i inloggningen vid begäran av säkerhetstoken.';
        try {
          if (error.response.data.response !== undefined) {
            errormsg = errprep + error.response.data.response;
          }
        } catch(e) {
          errormsg = errprep + 'Ett fel har uppstått i inloggningen vid begäran av säkerhetstoken. Felformaterat eller inget svar från API.';
        }
        dispatch(errorPopup({visible: true, message: errormsg}));
        dispatch({type: 'LOGIN', payload: {autoAttempt: false}});
        return Promise.reject();
      });
    
  };
}