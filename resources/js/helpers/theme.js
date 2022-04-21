const lato = "'Lato', 'Arial', sans-serif"
const merriweather = "'Merriweather', 'Georgia', serif"

const theme = {
  typography: {
    lato: lato,
    merriweather: merriweather,
    latoBold: {
      fontFamily: lato,
      fontWeight: 700
    },
    latoReg: {
      fontFamily: lato,
      fontWeight: 400
    },
    latoLite: {
      fontFamily: lato,
      fontWeight: 300
    },
    merriweatherBold: {
      fontFamily: merriweather,
      fontWeight: 700
    },
    merriweatherReg: {
      fontFamily: merriweather,
      fontWeight: 400
    },
    merriweatherLite: {
      fontFamily: merriweather,
      fontWeight: 300
    }
  },
  colors: {
    akcBlue: '#003594',
    akcBrightBlue: '#0099FF',
    akcA11yBlue: '#007ACC',
    begonia: '#FE5147',
    latte: '#51403D',
    penny: '#BB6E55',
    luna: '#F9E89E',
    white: '#FFFFFF',
    pepper: '#222223',
    cash: '#505053',
    gizmo: '#BABABA',
    shadow: '#DEDEDE',
    gray: '#F8F8F8',
    ad: '#EEEEEE',
    success: '#00BE29',
    failure: '#E2231A',
    attention: 'FFC827',
    akcDarkBlue: '#0072BF',
    darkBegonia: '#BE3C35',
    darkLatte: '#3C2F2D',
    darkPenny: '#8C523F',
    darkLuna: '#BAAD76'
  },
  limits: {
    componentMaxWidth: '1440px',
    contentMaxWidth: '960px'
  }
}

export default theme
