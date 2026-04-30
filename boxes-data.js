const BOXES_DATA = {

  gaming: {
    name: 'Gaming', emoji: '🎮',
    tierImages: {
      basic:    'photos/gaming-basic.jpg',
      standard: 'photos/gaming-standard.jpg',
      premium:  'photos/gaming-premium.jpg',
    },
    heroImg: 'photos/gaming-standard.jpg',
    desc: 'Surprize pentru gameri — accesorii, merchandise și colecții exclusive din lumea jocurilor video.',
    tiers: {
      basic: {
        price: '358 MDL', products: '1–3 produse', rarity: 'Common',
        items: [
          { emoji: '🎮', name: 'Controller skin personalizat', desc: 'Skin decorativ pentru PS5 sau Xbox — design exclusiv, ediție limitată.', chance: 72, rarity: 'common' },
          { emoji: '🖱️', name: 'Mouse pad XL gaming', desc: 'Mouse pad extins cu suprafață texturată și margini cusute.', chance: 65, rarity: 'common' },
          { emoji: '⌨️', name: 'Keycap set mecanic', desc: 'Set de 10 keycap-uri PBT double-shot cu design gaming retro.', chance: 55, rarity: 'common' },
          { emoji: '🃏', name: 'Card game exclusiv', desc: 'Joc de cărți tematic gaming — strategie și colecționare.', chance: 48, rarity: 'common' },
          { emoji: '🎯', name: 'Sticker pack gaming', desc: 'Set 20 stickere vinyl waterproof cu personaje iconice.', chance: 80, rarity: 'common' },
        ]
      },
      standard: {
        price: '748 MDL', products: '3–5 produse', rarity: 'Rare',
        items: [
          { emoji: '🎧', name: 'Headset stand RGB', desc: 'Suport premium pentru headset cu iluminare RGB și port USB.', chance: 58, rarity: 'rare' },
          { emoji: '🖱️', name: 'Mouse pad XXL desk mat', desc: 'Desk mat 900×400mm cu cusătură premium și bază antiderapantă.', chance: 50, rarity: 'rare' },
          { emoji: '💡', name: 'LED strip ambient 2m', desc: 'Bandă LED USB pentru setup — 12 moduri de culoare și efecte.', chance: 45, rarity: 'rare' },
          { emoji: '🏆', name: 'Figurină gaming collectible', desc: 'Figurină din vinil — personaj iconic din industria jocurilor.', chance: 35, rarity: 'rare' },
          { emoji: '⭐', name: 'Steelbook colecție', desc: 'Carcasă metalică pentru joc iconic — ediție de colecție numerotată.', chance: 22, rarity: 'epic' },
          { emoji: '🎮', name: 'Controller grip pro set', desc: 'Set grip-uri premium pentru DualSense sau Xbox, non-slip.', chance: 55, rarity: 'common' },
        ]
      },
      premium: {
        price: '1248 MDL', products: '5–8 produse', rarity: 'Epic',
        items: [
          { emoji: '🎧', name: 'Headset gaming wireless pro', desc: 'Căști wireless 7.1 surround, ANC activ, autonomie 30h, microfon retractabil.', chance: 40, rarity: 'epic' },
          { emoji: '⌨️', name: 'Tastatură mecanică TKL aluminiu', desc: 'Tastatură TKL cu switch-uri Cherry MX Red, RGB per taste, construcție aluminiu.', chance: 30, rarity: 'epic' },
          { emoji: '🖱️', name: 'Mouse gaming sensor 25K DPI', desc: 'Mouse cu senzor optic 25.600 DPI, 8 butoane programabile, greutate ajustabilă.', chance: 35, rarity: 'epic' },
          { emoji: '👑', name: 'Tricou gaming ediție limitată', desc: 'Tricou 100% bumbac organic cu print exclusiv, disponibil în cantitate limitată.', chance: 18, rarity: 'legend' },
          { emoji: '🎁', name: 'Bundle setup complet', desc: 'Pachet premium: suport monitor, hub USB-C, mouse bungee, cablu paracord.', chance: 25, rarity: 'epic' },
          { emoji: '💺', name: 'Pernă lombară gaming chair', desc: 'Pernă ergonomică memory foam pentru scaun gaming — suport lombar + cervical.', chance: 45, rarity: 'rare' },
          { emoji: '🏆', name: 'Artă gaming limitată (print A3)', desc: 'Print de artă A3 semnat de artist — scenă iconică din industria gaming.', chance: 12, rarity: 'legend' },
        ]
      }
    }
  },

  beauty: {
    name: 'Beauty', emoji: '💄',
    tierImages: {
      basic:    'photos/beauty-basic.jpg',
      standard: 'photos/beauty-standard.jpg',
      premium:  'photos/beauty-premium.jpg',
    },
    heroImg: 'photos/beauty-standard.jpg',
    desc: 'O selecție de produse cosmetice premium și skincare — branduri internaționale și formule inovatoare.',
    tiers: {
      basic: {
        price: '358 MDL', products: '2–3 produse', rarity: 'Common',
        items: [
          { emoji: '💋', name: 'Lip gloss set (3 nuanțe)', desc: 'Trio de lip gloss cu finisaj glossy și hidratare 12h.', chance: 75, rarity: 'common' },
          { emoji: '✨', name: 'Highlighter mineral', desc: 'Iluminator mineral cu particule fine — 3 nuanțe disponibile.', chance: 68, rarity: 'common' },
          { emoji: '🧴', name: 'Loțiune corp 250ml', desc: 'Loțiune cu shea butter și vitamina E — hidratare 24h.', chance: 72, rarity: 'common' },
          { emoji: '🖌️', name: 'Set pensule mini (3 buc)', desc: 'Set 3 pensule travel-size pentru ochi și față.', chance: 60, rarity: 'common' },
          { emoji: '🌸', name: 'Mist facial hidratant', desc: 'Spray facial cu apă termală și aloe vera — 100ml.', chance: 65, rarity: 'common' },
        ]
      },
      standard: {
        price: '748 MDL', products: '3–5 produse', rarity: 'Rare',
        items: [
          { emoji: '🧴', name: 'Serum vitamina C 15%', desc: 'Ser concentrat anti-oxidant cu 15% vitamina C pură stabilizată.', chance: 55, rarity: 'rare' },
          { emoji: '🫧', name: 'Mască față premium (5 aplicații)', desc: 'Mască cu acid hialuronic și extract de trufe.', chance: 48, rarity: 'rare' },
          { emoji: '🌸', name: 'Parfum travel size nișă 15ml', desc: 'Flacon de 15ml cu parfum nișă din colecție limitată.', chance: 40, rarity: 'rare' },
          { emoji: '💆', name: 'Roller Jade / Rose Quartz', desc: 'Roller facial din piatră naturală pentru masaj și tonifiere.', chance: 38, rarity: 'rare' },
          { emoji: '🫙', name: 'Cremă retinol 0.2%', desc: 'Cremă noapte cu retinol și peptide — 50ml.', chance: 30, rarity: 'rare' },
          { emoji: '🖌️', name: 'Set pensule profesionale (5 buc)', desc: 'Set 5 pensule vegan cu mânere gravate, husă inclusă.', chance: 45, rarity: 'common' },
        ]
      },
      premium: {
        price: '1248 MDL', products: '5–7 produse', rarity: 'Epic',
        items: [
          { emoji: '🌟', name: 'Paletă farduri ediție limitată', desc: 'Paletă 12 nuanțe — colecție colaborare artist-brand internațional.', chance: 35, rarity: 'epic' },
          { emoji: '🫙', name: 'Cremă retinol luxury 0.5%', desc: 'Cremă anti-age cu 0.5% retinol pur, peptide și ceramide — brand premium.', chance: 28, rarity: 'epic' },
          { emoji: '💐', name: 'Parfum 30ml brand premium', desc: 'Apă de parfum 30ml din colecție exclusivă — brand internațional de lux.', chance: 22, rarity: 'epic' },
          { emoji: '🎭', name: 'Kit skincare complet (5 pași)', desc: 'Set complet: cleanser, toner, serum, moisturizer, SPF — brand coreean premium.', chance: 18, rarity: 'epic' },
          { emoji: '💎', name: 'Contur ochi 24K Gold', desc: 'Patch-uri premium pentru ochi cu particule de aur și colagen.', chance: 40, rarity: 'rare' },
          { emoji: '🌿', name: 'Ulei facial CBD + Bakuchiol', desc: 'Ulei facial anti-age cu CBD 500mg și bakuchiol organic.', chance: 15, rarity: 'legend' },
          { emoji: '👑', name: 'Trusă makeup profesională', desc: 'Trusă completă 20 produse — ediție colecție exclusivă, husă inclusă.', chance: 10, rarity: 'legend' },
        ]
      }
    }
  },

  gadget: {
    name: 'Gadget', emoji: '📱',
    tierImages: {
      basic:    'photos/gadget-basic.jpg',
      standard: 'photos/gadget-standard.jpg',
      premium:  'photos/gadget-premium.jpg',
    },
    heroImg: 'photos/gadget-standard.jpg',
    desc: 'Gadgeturi și accesorii tech de ultimă generație — produse care îți simplifică viața de zi cu zi.',
    tiers: {
      basic: {
        price: '358 MDL', products: '1–2 produse', rarity: 'Common',
        items: [
          { emoji: '🔋', name: 'Power bank 10000mAh slim', desc: 'Power bank ultra-slim cu încărcare rapidă 22.5W și display digital.', chance: 70, rarity: 'common' },
          { emoji: '🎵', name: 'Căști wireless in-ear', desc: 'Căști TWS cu autonomie 6h + 18h carcasă, latență redusă gaming mode.', chance: 62, rarity: 'common' },
          { emoji: '💡', name: 'Lampă LED touch dimabilă', desc: 'Lampă de birou cu 3 moduri de culoare, touch control și port USB.', chance: 58, rarity: 'common' },
          { emoji: '🔌', name: 'Hub USB-C 7 în 1', desc: 'Hub cu HDMI 4K, 3x USB-A, SD card, USB-C PD 100W.', chance: 50, rarity: 'common' },
          { emoji: '📱', name: 'Suport telefon magnetic', desc: 'Suport MagSafe compatibil pentru birou și mașină — rotire 360°.', chance: 75, rarity: 'common' },
        ]
      },
      standard: {
        price: '748 MDL', products: '2–3 produse', rarity: 'Rare',
        items: [
          { emoji: '🤖', name: 'Difuzor smart Bluetooth 360°', desc: 'Difuzor waterproof IPX7, sunet 360°, autonomie 24h, LED ambient.', chance: 48, rarity: 'rare' },
          { emoji: '📸', name: 'Gimbal stabilizator telefon', desc: 'Gimbal 3 axe pentru smartphone, tracking automat, autonomie 8h.', chance: 40, rarity: 'rare' },
          { emoji: '🔋', name: 'Încărcător wireless 3 în 1', desc: 'Pad de încărcare pentru telefon, smartwatch și căști simultan — 15W.', chance: 52, rarity: 'rare' },
          { emoji: '🎮', name: 'Controller gaming mobil', desc: 'Gamepad telescopic pentru smartphone, compatibil iOS și Android.', chance: 44, rarity: 'rare' },
          { emoji: '💡', name: 'Bandă LED smart RGB 5m', desc: 'Bandă LED controlată din aplicație, sincronizare muzică, 16M culori.', chance: 38, rarity: 'rare' },
        ]
      },
      premium: {
        price: '1248 MDL', products: '3–5 produse', rarity: 'Epic',
        items: [
          { emoji: '📸', name: 'Camera acțiune 4K/60fps', desc: 'Camera 4K cu stabilizare EIS, waterproof 30m, ecran touch, accesorii incluse.', chance: 20, rarity: 'epic' },
          { emoji: '🤖', name: 'Smart ring biometric', desc: 'Inel smart cu monitorizare somn, SpO2, activitate, baterie 7 zile.', chance: 18, rarity: 'epic' },
          { emoji: '🖥️', name: 'Monitor light bar LED', desc: 'Bară LED pentru monitor cu senzor ambient, fără reflexii, USB-C.', chance: 35, rarity: 'rare' },
          { emoji: '🔋', name: 'Power bank solar 20000mAh', desc: 'Power bank cu panou solar, 3 porturi, 65W PD, display digital.', chance: 30, rarity: 'epic' },
          { emoji: '👑', name: 'Earbuds premium flagship', desc: 'Căști ANC flagship — ediție limitată cu geantă premium inclusă.', chance: 8, rarity: 'legend' },
        ]
      }
    }
  },

  snack: {
    name: 'Snack', emoji: '🍫',
    tierImages: {
      basic:    'photos/snack-basic.jpg',
      standard: 'photos/snack-standard.jpg',
      premium:  'photos/snack-premium.jpg',
    },
    heroImg: 'photos/snack-standard.jpg',
    desc: 'O experiență culinară globală — snack-uri rare și dulciuri din întreaga lume, curate cu grijă.',
    tiers: {
      basic: {
        price: '268 MDL', products: '4–6 produse', rarity: 'Common',
        items: [
          { emoji: '🍫', name: 'Ciocolată artizanală 70%', desc: 'Tabletă single-origin — Belgia sau Ecuador, 100g.', chance: 80, rarity: 'common' },
          { emoji: '🍬', name: 'Candy mix Japonia', desc: 'Asortiment bomboane japoneze Hi-Chew, Ramune, Pop Rocks.', chance: 75, rarity: 'common' },
          { emoji: '🌶️', name: 'Chips extra spicy Korea', desc: 'Chips coreene cu ardei ghost pepper — nivel foc garantat.', chance: 70, rarity: 'common' },
          { emoji: '🧁', name: 'Cookie butter spread 250g', desc: 'Cremă de biscuiți olandeză — Speculoos original.', chance: 65, rarity: 'common' },
          { emoji: '🍭', name: 'Lollipop gourmet artizanal', desc: 'Acadele cu arome exotice — mango-chili sau lavandă-miere.', chance: 72, rarity: 'common' },
          { emoji: '🥜', name: 'Snack mix exotic (3 arome)', desc: 'Mix nuci cu arome internaționale — wasabi, BBQ, curry.', chance: 68, rarity: 'common' },
        ]
      },
      standard: {
        price: '623 MDL', products: '7–10 produse', rarity: 'Rare',
        items: [
          { emoji: '🫖', name: 'Ceai matcha ceremonial Uji', desc: 'Matcha grade A din Uji, Japonia — 30g cu linguriță bambus.', chance: 45, rarity: 'rare' },
          { emoji: '🥜', name: 'Nut butter exotic 200g', desc: 'Unt de macadamia cu vanilie bourbon sau cocos cu cacao.', chance: 40, rarity: 'rare' },
          { emoji: '🍫', name: 'Set praline belgiene (9 buc)', desc: 'Cutie 9 praline belgiene cu umpluturi diverse, ambalaj premium.', chance: 38, rarity: 'rare' },
          { emoji: '🌟', name: 'Trufe ciocolată set (6 buc)', desc: 'Trufe belgiene: champagne, caramel sărat, pistachio, whisky.', chance: 28, rarity: 'rare' },
          { emoji: '🍾', name: 'Sirop artizanal cocktail', desc: 'Sirop craft 200ml: lavandă, hibiscus sau yuzu.', chance: 35, rarity: 'rare' },
          { emoji: '🫙', name: 'Gem artizanal fructe rare', desc: 'Gem 200g cu ingrediente rare: fig & vanilla, yuzu, passion fruit.', chance: 50, rarity: 'rare' },
        ]
      },
      premium: {
        price: '998 MDL', products: '10–15 produse', rarity: 'Epic',
        items: [
          { emoji: '🍫', name: 'Ciocolată single-origin rară 85%', desc: 'Tabletă 100g cacao din Madagascar sau Vietnam — certificat origine inclusă.', chance: 35, rarity: 'epic' },
          { emoji: '☕', name: 'Cafea specialty 250g', desc: 'Cafea specialty roast — fermă single-origin, profil de aromă detaliat.', chance: 30, rarity: 'epic' },
          { emoji: '🍵', name: 'Ceai Da Hong Pao oolong rar', desc: 'Ceai oolong de rocă din Wuyi — una din cele mai valoroase varietăți din China.', chance: 18, rarity: 'epic' },
          { emoji: '🫙', name: 'Miere Manuka MGO 400+', desc: 'Miere autentică din Noua Zeelandă cu certificat MGO 400+, 250g.', chance: 22, rarity: 'epic' },
          { emoji: '🍾', name: 'Set cocktail premium 3 siropuri', desc: '3 siropuri craft (100ml) + rețete exclusive din bartender NYC.', chance: 25, rarity: 'rare' },
          { emoji: '🌿', name: 'Set condimente rare mondiale', desc: '5 condimente rare: saffron iranian, trufe albe, fleur de sel, sumac, berbere.', chance: 12, rarity: 'legend' },
          { emoji: '👑', name: 'Hamper gourmet internațional', desc: 'Coș curatorial cu 6 produse gourmet din 6 țări diferite.', chance: 8, rarity: 'legend' },
        ]
      }
    }
  },

  sport: {
    name: 'Sport & Fitness', emoji: '🏋️',
    tierImages: {
      basic:    'photos/sport-basic.jpg',
      standard: 'photos/sport-standard.jpg',
      premium:  'photos/sport-premium.jpg',
    },
    heroImg: 'photos/sport-standard.jpg',
    desc: 'Echipament și accesorii pentru antrenamente — produse care te ajută să-ți atingi obiectivele fitness.',
    tiers: {
      basic: {
        price: '358 MDL', products: '2–3 produse', rarity: 'Common',
        items: [
          { emoji: '💪', name: 'Rezistband set (3 niveluri)', desc: 'Elastic-benzi rezistență pentru full-body workout — ușor, mediu, greu.', chance: 78, rarity: 'common' },
          { emoji: '🧢', name: 'Șapcă running reflectorizantă', desc: 'Șapcă cu bandă reflectorizantă 360° și buzunar spate.', chance: 70, rarity: 'common' },
          { emoji: '🫙', name: 'Shaker proteic 700ml', desc: 'Shaker BPA-free cu filtru metalic și compartiment supliment.', chance: 65, rarity: 'common' },
          { emoji: '📊', name: 'Journal antrenament A5', desc: 'Caiet fitness cu tracker săptămânal și citate motivaționale.', chance: 72, rarity: 'common' },
          { emoji: '🩹', name: 'Bandaj elastic sport 5m', desc: 'Bandaj self-adhesive pentru articulații și suport muscular.', chance: 68, rarity: 'common' },
        ]
      },
      standard: {
        price: '823 MDL', products: '3–5 produse', rarity: 'Rare',
        items: [
          { emoji: '⚡', name: 'Jump rope speed competition', desc: 'Coardă din cablu oțel 3mm, mânere aluminiu, counter digital și bearings.', chance: 45, rarity: 'rare' },
          { emoji: '🧘', name: 'Yoga block set + strap', desc: 'Duo blocuri EVA dens 10cm + curea stretching 183cm, 8 poziții.', chance: 48, rarity: 'rare' },
          { emoji: '🌡️', name: 'Muscle roller vibrant', desc: 'Roller vibrant 3 viteze — recuperare musculară post-antrenament.', chance: 38, rarity: 'rare' },
          { emoji: '🎽', name: 'Tricou compression UPF50+', desc: 'Tricou compresie quick-dry cu protecție UV și cusături plate ergonomice.', chance: 42, rarity: 'rare' },
          { emoji: '🎯', name: 'Fitness tracker band', desc: 'Brățară fitness cu pași, calorii, somn, HR — baterie 15 zile.', chance: 30, rarity: 'rare' },
          { emoji: '💊', name: 'Electrolyte supliment 20 plicuri', desc: 'Electrolyte sport fără zahăr cu arome naturale.', chance: 55, rarity: 'common' },
        ]
      },
      premium: {
        price: '1373 MDL', products: '5–8 produse', rarity: 'Epic',
        items: [
          { emoji: '🏆', name: 'Smart skipping rope OLED', desc: 'Coardă inteligentă cu ecran OLED — numărătoare, calorii, timp, app sync.', chance: 30, rarity: 'epic' },
          { emoji: '🌡️', name: 'Pistol masaj percuție pro', desc: 'Pistol de masaj cu 6 capete, 20 viteze, display OLED, husă transport.', chance: 22, rarity: 'epic' },
          { emoji: '⌚', name: 'GPS running watch', desc: 'Ceas GPS cu HR, SpO2, route tracking, autonomie 14 zile, waterproof 50m.', chance: 15, rarity: 'legend' },
          { emoji: '🎽', name: 'Kit compresie recovery (2 pcs)', desc: 'Jambiere + mânuși compresie graduated pentru recuperare activă.', chance: 38, rarity: 'rare' },
          { emoji: '💊', name: 'Bundle suplimente premium', desc: 'Set: creatina monohidrat 300g + BCAA 200g + pre-workout 20 doze.', chance: 28, rarity: 'epic' },
          { emoji: '👟', name: 'Inserție carbon running', desc: 'Talpă carbon pentru pantofi alergare — creștere eficiență 4% certificat.', chance: 25, rarity: 'epic' },
          { emoji: '👑', name: 'Foam roller vibrant premium', desc: 'Roller vibrant Therabody / Hyperice cu 6 viteze — husă transport inclusă.', chance: 8, rarity: 'legend' },
        ]
      }
    }
  }
};
