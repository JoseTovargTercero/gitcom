/*
c_Selva_del_Amazonas_Final.once("data:loaded", function() {
    alert('Se cargo el shp')
});*/

var shpControl = L.control.layers();

var c_Selva_del_Amazonas_Final = new L.Shapefile(
  "capasCargadas/Selva del Amazonas Final.zip",
  {
    onEachFeature: function (feature, layer) {
      if (feature.properties) {
        layer.bindPopup(
          Object.keys(feature.properties)
            .map(function (k) {
              return k + ": " + feature.properties[k];
            })
            .join("<br />"),
          {
            maxHeight: 200,
          }
        );
      }
    },
    style: function (feature) {
      return {
        color: "#ffffff",
        fillColor: "#ffffff",
        fillOpacity: 0.25,
        dashArray: "4",
      };
    },
  }
);
c_Selva_del_Amazonas_Final.addTo(map);

shpControl.addOverlay(
  c_Selva_del_Amazonas_Final,
  '<img width="13px" src="legend/shapes.png" />  Poligono Selva del Amazonas'
);

var c_Segunda_Ruta = new L.Shapefile("capasCargadas/Segunda Ruta.zip", {
  onEachFeature: function (feature, layer) {
    if (feature.properties) {
      layer.bindPopup(
        Object.keys(feature.properties)
          .map(function (k) {
            return k + ": " + feature.properties[k];
          })
          .join("<br />"),
        {
          maxHeight: 200,
        }
      );
    }
  },
  style: function (feature) {
    return { color: "#ff0000", fillColor: "#ff0000", fillOpacity: 0.25 };
  },
});
shpControl.addOverlay(
  c_Segunda_Ruta,
  '<img width="13px" src="legend/shapes.png" />  Ruta de la Cisterna'
);

var c_Asfalto_Esc = new L.Shapefile("capasCargadas/Asfalto.zip", {
  onEachFeature: function (feature, layer) {
    if (feature.properties) {
      layer.bindPopup(
        Object.keys(feature.properties)
          .map(function (k) {
            return k + ": " + feature.properties[k];
          })
          .join("<br />"),
        {
          maxHeight: 200,
        }
      );
    }
  },
  style: function (feature) {
    return { color: "#ff0000", fillColor: "#ff0000", fillOpacity: 0.25 };
  },
});
shpControl.addOverlay(
  c_Asfalto_Esc,
  '<img width="13px" src="legend/shapes.png" />  Asfalto'
);

var c_Bocas_de_Visita = new L.Shapefile("capasCargadas/Bocas de Visita.zip", {
  onEachFeature: function (feature, layer) {
    if (feature.properties) {
      layer.bindPopup(
        Object.keys(feature.properties)
          .map(function (k) {
            return k + ": " + feature.properties[k];
          })
          .join("<br />"),
        {
          maxHeight: 200,
        }
      );
    }
    layer.setIcon(
      new L.Icon({
        iconUrl: "images/dot/dot_4.png",
      })
    );
  },
  style: function (feature) {
    return { color: "#b30000", fillColor: "#ff0000", fillOpacity: 0.25 };
  },
});
shpControl.addOverlay(
  c_Bocas_de_Visita,
  '<img width="13px" src="legend/shapes.png" />  Bocas de Visita'
);

var c_Fugas_Corregidas = new L.Shapefile("capasCargadas/Fugas Corregidas.zip", {
  onEachFeature: function (feature, layer) {
    if (feature.properties) {
      layer.bindPopup(
        Object.keys(feature.properties)
          .map(function (k) {
            return k + ": " + feature.properties[k];
          })
          .join("<br />"),
        {
          maxHeight: 200,
        }
      );
    }
    layer.setIcon(
      new L.Icon({
        iconUrl: "images/dot/dot_1.png",
      })
    );
  },
  style: function (feature) {
    return { color: "#ff0000", fillColor: "#ff0000", fillOpacity: 0.25 };
  },
});
shpControl.addOverlay(
  c_Fugas_Corregidas,
  '<img width="13px" src="legend/shapes.png" />  Fugas Corregidas'
);

var c_Red_de_Cloacas = new L.Shapefile("capasCargadas/Red de Cloacas.zip", {
  onEachFeature: function (feature, layer) {
    if (feature.properties) {
      layer.bindPopup(
        Object.keys(feature.properties)
          .map(function (k) {
            return k + ": " + feature.properties[k];
          })
          .join("<br />"),
        {
          maxHeight: 200,
        }
      );
    }
  },
  style: function (feature) {
    return { color: "#cc0000", fillColor: "#ff0000", fillOpacity: 0.25 };
  },
});
shpControl.addOverlay(
  c_Red_de_Cloacas,
  '<img width="13px" src="legend/shapes.png" />  Red de Cloacas'
);

var highlight = {
  fillColor: "yellow",
  weight: 2,
  opacity: 1,
};

/*	var c_Selva_del__Amazonas2 = new L.Shapefile('capasCargadas/Selva del  Amazonas2.zip', {
		onEachFeature: function(feature, layer) {

			var popupContent = "<p>Concejo Comunal: "+ feature.properties.NAME +"<br>Parroquia: "+ feature.properties.parroquia +"<br>Area: "+ feature.properties.Area +" Metros</p>";
			layer.bindPopup(popupContent);

			layer.on("click", function (e) { 
				c_Selva_del__Amazonas2.setStyle({
					color: '#ffffff', fillColor: '#ffffff', fillOpacity: .25,  dashArray: '3'
			}); //resets layer colors
				layer.setStyle(highlight);  //highlights selected.
			}); 
		},
		style: function (feature) {
			return {color: '#ffffff', fillColor: '#ffffff', fillOpacity: .25,  dashArray: '3'}
		}
	});
	shpControl.addOverlay(c_Selva_del__Amazonas2, '<img width="13px" src="legend/shapes.png" />  Selva del  Amazonas (Blanco)');
	*/

var c_Con_Luminaria = new L.Shapefile("capasCargadas/Con Luminaria.zip", {
  onEachFeature: function (feature, layer) {
    if (feature.properties) {
      layer.bindPopup(
        Object.keys(feature.properties)
          .map(function (k) {
            return k + ": " + feature.properties[k];
          })
          .join("<br />"),
        {
          maxHeight: 200,
        }
      );
    }
    layer.setIcon(
      new L.Icon({
        iconUrl: "images/dot/dot_1.png",
        iconSize: [13, 13],
        popupAnchor: [0, -4],
      })
    );
  },
  style: function (feature) {
    return { color: "#f4a4a4", fillColor: "#c97373", fillOpacity: 0.25 };
  },
});

shpControl.addOverlay(
  c_Con_Luminaria,
  '<img width="13px" src="legend/shapes.png" />  Con Luminaria'
);

var c_Sin_Luminaria = new L.Shapefile("capasCargadas/Sin Luminaria.zip", {
  onEachFeature: function (feature, layer) {
    if (feature.properties) {
      layer.bindPopup(
        Object.keys(feature.properties)
          .map(function (k) {
            return k + ": " + feature.properties[k];
          })
          .join("<br />"),
        {
          maxHeight: 200,
        }
      );
    }
    layer.setIcon(
      new L.Icon({
        iconUrl: "images/dot/dot_6.png",
        iconSize: [13, 13],
        popupAnchor: [0, -4],
      })
    );
  },
  style: function (feature) {
    return { color: "#9e4c4c", fillColor: "#e64141", fillOpacity: 0.25 };
  },
});
shpControl.addOverlay(
  c_Sin_Luminaria,
  '<img width="13px" src="legend/shapes.png" />  Sin Luminaria'
);

var c_Vialidad_de_tierra_a_recuperar = new L.Shapefile(
  "capasCargadas/Vialidad de tierra a recuperar.zip",
  {
    onEachFeature: function (feature, layer) {
      if (feature.properties) {
        layer.bindPopup(
          Object.keys(feature.properties)
            .map(function (k) {
              return k + ": " + feature.properties[k];
            })
            .join("<br />"),
          {
            maxHeight: 200,
          }
        );
      }
    },
    style: function (feature) {
      return { color: "#00b3ff", fillColor: "#00d5ff", fillOpacity: 0.25 };
    },
  }
);
shpControl.addOverlay(
  c_Vialidad_de_tierra_a_recuperar,
  '<img width="13px" src="legend/shapes.png" />  Vialidad de tierra a recuperar'
);

var c_Vialidad_de_cemento_a_recuperar = new L.Shapefile(
  "capasCargadas/Vialidad de cemento a recuperar.zip",
  {
    onEachFeature: function (feature, layer) {
      if (feature.properties) {
        layer.bindPopup(
          Object.keys(feature.properties)
            .map(function (k) {
              return k + ": " + feature.properties[k];
            })
            .join("<br />"),
          {
            maxHeight: 200,
          }
        );
      }
    },
    style: function (feature) {
      return { color: "#00f549", fillColor: "#22cc00", fillOpacity: 0.25 };
    },
  }
);
shpControl.addOverlay(
  c_Vialidad_de_cemento_a_recuperar,
  '<img width="13px" src="legend/shapes.png" />  Vialidad de cemento a recuperar'
);

var c_Ruta_de_Saneamiento_Final_2 = new L.Shapefile(
  "capasCargadas/Ruta de Saneamiento Final 2.zip",
  {
    onEachFeature: function (feature, layer) {
      if (feature.properties) {
        layer.bindPopup(
          Object.keys(feature.properties)
            .map(function (k) {
              return k + ": " + feature.properties[k];
            })
            .join("<br />"),
          {
            maxHeight: 200,
          }
        );
      }
    },
    style: function (feature) {
      return { color: "#ff8800", fillColor: "#ff8800", fillOpacity: 0.25 };
    },
  }
);
shpControl.addOverlay(
  c_Ruta_de_Saneamiento_Final_2,
  '<img width="13px" src="legend/shapes.png" />  Ruta de Saneamiento'
);

var c_tuberiaExistente = new L.Shapefile("capasCargadas/tuberiaExistente.zip", {
  onEachFeature: function (feature, layer) {
    if (feature.properties) {
      layer.bindPopup(
        Object.keys(feature.properties)
          .map(function (k) {
            return k + ": " + feature.properties[k];
          })
          .join("<br />"),
        {
          maxHeight: 200,
        }
      );
    }
  },
  style: function (feature) {
    return { color: "#004cff", fillColor: "#0091ff", fillOpacity: 0.25 };
  },
});
shpControl.addOverlay(
  c_tuberiaExistente,
  '<img width="13px" src="legend/shapes.png" />  tuberiaExistente'
);

var c_tuberiaPropuesta = new L.Shapefile("capasCargadas/tuberiaPropuesta.zip", {
  onEachFeature: function (feature, layer) {
    if (feature.properties) {
      layer.bindPopup(
        Object.keys(feature.properties)
          .map(function (k) {
            return k + ": " + feature.properties[k];
          })
          .join("<br />"),
        {
          maxHeight: 200,
        }
      );
    }
  },
  style: function (feature) {
    return { color: "#ff0000", fillColor: "#ff0000", fillOpacity: 0.25 };
  },
});
shpControl.addOverlay(
  c_tuberiaPropuesta,
  '<img width="13px" src="legend/shapes.png" />  tuberiaPropuesta'
);

var c_tuberiaRemplazar = new L.Shapefile("capasCargadas/tuberiaRemplazar.zip", {
  onEachFeature: function (feature, layer) {
    if (feature.properties) {
      layer.bindPopup(
        Object.keys(feature.properties)
          .map(function (k) {
            return k + ": " + feature.properties[k];
          })
          .join("<br />"),
        {
          maxHeight: 200,
        }
      );
    }
  },
  style: function (feature) {
    return { color: "#00ff04", fillColor: "#00ff1e", fillOpacity: 0.25 };
  },
});
shpControl.addOverlay(
  c_tuberiaRemplazar,
  '<img width="13px" src="legend/shapes.png" />  tuberiaRemplazar'
);




var c_valvulasExistentes = new L.Shapefile(
  "capasCargadas/valvulasExistentes.zip",
  {
    onEachFeature: function (feature, layer) {
      if (feature.properties) {
        layer.bindPopup(
          Object.keys(feature.properties)
            .map(function (k) {
              return k + ": " + feature.properties[k];
            })
            .join("<br />"),
          {
            maxHeight: 200,
          }
        );
      }
      layer.setIcon(
        new L.Icon({
          iconUrl: "images/dot/dot_6.png",
          iconSize: [13, 13],
          popupAnchor: [0, -4],
        })
      );
    },
    style: function (feature) {
      return { color: "#000000", fillColor: "#000000", fillOpacity: 0.25 };
    },
  }
);
shpControl.addOverlay(
  c_valvulasExistentes,
  '<img width="13px" src="legend/shapes.png" />  valvulasExistentes'
);

var c_valvulasPropuestas = new L.Shapefile(
  "capasCargadas/valvulasPropuestas.zip",
  {
    onEachFeature: function (feature, layer) {
      if (feature.properties) {
        layer.bindPopup(
          Object.keys(feature.properties)
            .map(function (k) {
              return k + ": " + feature.properties[k];
            })
            .join("<br />"),
          {
            maxHeight: 200,
          }
        );
      }
      layer.setIcon(
        new L.Icon({
          iconUrl: "images/dot/dot_1.png",
          iconSize: [13, 13],
          popupAnchor: [0, -4],
        })
      );
    },
    style: function (feature) {
      return { color: "#ff0000", fillColor: "#fa0000", fillOpacity: 0.25 };
    },
  }
);
shpControl.addOverlay(
  c_valvulasPropuestas,
  '<img width="13px" src="legend/shapes.png" />  valvulasPropuestas'
);
var c_Vialidad_de_tierra = new L.Shapefile(
  "capasCargadas/Vialidad de tierra.zip",
  {
    onEachFeature: function (feature, layer) {
      if (feature.properties) {
        layer.bindPopup(
          Object.keys(feature.properties)
            .map(function (k) {
              return k + ": " + feature.properties[k];
            })
            .join("<br />"),
          {
            maxHeight: 200,
          }
        );
      }
    },
    style: function (feature) {
      return { color: "#ffae00", fillColor: "#fa9e00", fillOpacity: 0.25 };
    },
  }
);
shpControl.addOverlay(
  c_Vialidad_de_tierra,
  '<img width="13px" src="legend/shapes.png" />  Vialidad de tierra'
);
var c_Vialidad_de_asfalto = new L.Shapefile(
  "capasCargadas/Vialidad de asfalto.zip",
  {
    onEachFeature: function (feature, layer) {
      if (feature.properties) {
        layer.bindPopup(
          Object.keys(feature.properties)
            .map(function (k) {
              return k + ": " + feature.properties[k];
            })
            .join("<br />"),
          {
            maxHeight: 200,
          }
        );
      }
    },
    style: function (feature) {
      return { color: "#ff0000", fillColor: "#ff0000", fillOpacity: 0.25 };
    },
  }
);
shpControl.addOverlay(
  c_Vialidad_de_asfalto,
  '<img width="13px" src="legend/shapes.png" />  Vialidad de asfalto'
);
var c_Puntos_de_recoleccion_de_cilindros = new L.Shapefile(
  "capasCargadas/Puntos de recoleccion de cilindros.zip",
  {
    onEachFeature: function (feature, layer) {
      if (feature.properties) {
        layer.bindPopup(
          Object.keys(feature.properties)
            .map(function (k) {
              return k + ": " + feature.properties[k];
            })
            .join("<br />"),
          {
            maxHeight: 200,
          }
        );
      }
    },
    style: function (feature) {
      return { color: "#c70000", fillColor: "#ff0000", fillOpacity: 0.25 };
    },
  }
);
shpControl.addOverlay(
  c_Puntos_de_recoleccion_de_cilindros,
  '<img width="13px" src="legend/shapes.png" />  Puntos de recoleccion de cilindros'
);
var c_Municipios = new L.Shapefile("capasCargadas/Municipios.zip", {
  onEachFeature: function (feature, layer) {
    if (feature.properties) {
      layer.bindPopup(
        Object.keys(feature.properties)
          .map(function (k) {
            return k + ": " + feature.properties[k];
          })
          .join("<br />"),
        {
          maxHeight: 200,
        }
      );
    }
  },
  style: function (feature) {
    return { color: "#cc0000", fillColor: "#fe3e3e", fillOpacity: 0.25 };
  },
});
shpControl.addOverlay(
  c_Municipios,
  '<img width="13px" src="legend/shapes.png" />  Municipios'
);

var geometrias = 0;



var c_Hidrografia_de_Pto_Ayacucho = new L.Shapefile(
  "capasCargadas/Hidrografia de Pto Ayacucho.zip",
  {
    onEachFeature: function (feature, layer) {
      if (feature.properties) {
        layer.bindPopup(
          Object.keys(feature.properties)
            .map(function (k) {
              return k + ": " + feature.properties[k];
            })
            .join("<br />"),
          {
            maxHeight: 200,
          }
        );
      }
    },
    style: function (feature) {
      return { color: "#007bff", fillColor: "#009dff", fillOpacity: 0.25 };
    },
  }
);
shpControl.addOverlay(
  c_Hidrografia_de_Pto_Ayacucho,
  '<img width="13px" src="legend/shapes.png" />  Hidrografia de Pto Ayacucho'
);
