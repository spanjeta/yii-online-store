jQuery(document).ready(function() {
    "use strict";
    /* Menu */
    slideEffectAjax()
    jQuery(".toggle").on("click", function() {
        return jQuery(".submenu").is(":hidden") ? jQuery(".submenu").slideDown("fast") : jQuery(".submenu").slideUp("fast"), !1
    }), jQuery(".topnav").accordion({
        accordion: !1,
        speed: 300,
        closedSign: "+",
        openedSign: "-"
    }), jQuery("#nav > li").hover(function() {
        var e = jQuery(this).find(".level0-wrapper");
        e.hide(), e.css("left", "0"), e.stop(true, true).delay(150).fadeIn(300, "easeOutCubic")
    }, function() {
        jQuery(this).find(".level0-wrapper").stop(true, true).delay(300).fadeOut(300, "easeInCubic")
    });
    jQuery("#nav li.level0.drop-menu").mouseover(function() {
            return jQuery(window).width() >= 740 && jQuery(this).children("ul.level1").fadeIn(100), !1
        }).mouseleave(function() {
            return jQuery(window).width() >= 740 && jQuery(this).children("ul.level1").fadeOut(100), !1
        }), jQuery("#nav li.level0.drop-menu li").mouseover(function() {
            if (jQuery(window).width() >= 740) {
                jQuery(this).children("ul").css({
                    top: 0,
                    left: "165px"
                });
                var e = jQuery(this).offset();
                e && jQuery(window).width() < e.left + 325 ? (jQuery(this).children("ul").removeClass("right-sub"), jQuery(this).children("ul").addClass("left-sub"), jQuery(this).children("ul").css({
                    top: 0,
                    left: "-167px"
                })) : (jQuery(this).children("ul").removeClass("left-sub"), jQuery(this).children("ul").addClass("right-sub")), jQuery(this).children("ul").fadeIn(100)
            }
        }).mouseleave(function() {
            jQuery(window).width() >= 740 && jQuery(this).children("ul").fadeOut(100)
        }),
				

/* Mobile Menu */	

        jQuery("#mobile-menu").mobileMenu({
            MenuWidth: 250,
            SlideSpeed: 300,
            WindowsMaxWidth: 767,
            PagePush: !0,
            FromLeft: !0,
            Overlay: !0,
            CollapseMenu: !0,
            ClassName: "mobile-menu"
        })
	

/* Sidebar Menu */
        jQuery("ul.accordion li.parent, ul.accordion li.parents, ul#magicat li.open").each(function() {
            jQuery(this).append('<em class="open-close">&nbsp;</em>')
        }), jQuery("ul.accordion, ul#magicat").accordionNew(), jQuery("ul.accordion li.active, ul#magicat li.active").each(function() {
            jQuery(this).children().next("div").css("display", "block")
        })

    /* Cart */
    function deleteCartInCheckoutPage() {
        return jQuery(".checkout-cart-index a.btn-remove2,.checkout-cart-index a.btn-remove").on("click", function(e) {
            return e.preventDefault(), confirm(confirm_content) ? void 0 : !1
        }), !1
    }
	 jQuery(".subDropdown")[0] && jQuery(".subDropdown").on("click", function() {
            jQuery(this).toggleClass("plus"), jQuery(this).toggleClass("minus"), jQuery(this).parent().find("ul").slideToggle()
        })
    /* Top Cart */
    function slideEffectAjax() {
        jQuery(".fl-cart-contain").mouseenter(function() {
            jQuery(this).find(".fl-mini-cart-content").stop(true, true).slideDown()
        }), jQuery(".fl-cart-contain").mouseleave(function() {
            jQuery(this).find(".fl-mini-cart-content").stop(true, true).slideUp()
        })
    }

    function deleteCartInSidebar() {
        return is_checkout_page > 0 ? !1 : void jQuery("#cart-sidebar a.btn-remove, #mini_cart_block a.btn-remove").each(function() {})
    }

})


var isTouchDevice = "ontouchstart" in window || navigator.msMaxTouchPoints > 0;
jQuery(window).on("load", function() {
        isTouchDevice && jQuery("#nav a.level-top").on("click", function() {
            if ($t = jQuery(this), $parent = $t.parent(), $parent.hasClass("parent")) {
                if (!$t.hasClass("menu-ready")) return jQuery("#nav a.level-top").removeClass("menu-ready"), $t.addClass("menu-ready"), !1;
                $t.removeClass("menu-ready")
            }
        }), jQuery().UItoTop()
    }),
  

	
	/* Responsive Nav */	
    function(e) {
        e.fn.extend({
            accordion: function(t) {
                var n = {
                        accordion: "true",
                        speed: 300,
                        closedSign: "[+]",
                        openedSign: "[-]"
                    },
                    i = e.extend(n, t),
                    s = e(this);
                s.find("li").each(function() {
                    0 != e(this).find("ul").size() && (e(this).find("a:first").after("<em>" + i.closedSign + "</em>"), "#" == e(this).find("a:first").attr("href") && e(this).find("a:first").on("click", function() {
                        return !1
                    }))
                }), s.find("li em").on("click", function() {
                    0 != e(this).parent().find("ul").size() && (i.accordion && (e(this).parent().find("ul").is(":visible") || (parents = e(this).parent().parents("ul"), visible = s.find("ul:visible"), visible.each(function(t) {
                        var n = !0;
                        parents.each(function(e) {
                            return parents[e] == visible[t] ? (n = !1, !1) : void 0
                        }), n && e(this).parent().find("ul") != visible[t] && e(visible[t]).slideUp(i.speed, function() {
                            e(this).parent("li").find("em:first").html(i.closedSign)
                        })
                    }))), e(this).parent().find("ul:first").is(":visible") ? e(this).parent().find("ul:first").slideUp(i.speed, function() {
                        e(this).parent("li").find("em:first").delay(i.speed).html(i.closedSign)
                    }) : e(this).parent().find("ul:first").slideDown(i.speed, function() {
                        e(this).parent("li").find("em:first").delay(i.speed).html(i.openedSign)
                    }))
                })
            }
        })
    }(jQuery),
    function(e) {
        e.fn.extend({
                accordionNew: function() {
                    return this.each(function() {
                        function t(t, i) {
                            e(t).parent(l).siblings().removeClass(s).children(c).slideUp(r), e(t).siblings(c)[i || o]("show" == i ? r : !1, function() {
                                e(t).siblings(c).is(":visible") ? e(t).parents(l).not(n.parents()).addClass(s) : e(t).parent(l).removeClass(s), "show" == i && e(t).parents(l).not(n.parents()).addClass(s), e(t).parents().show()
                            })
                        }
                        var n = e(this),
                            i = "accordiated",
                            s = "active",
                            o = "slideToggle",
                            c = "ul, div",
                            r = "fast",
                            l = "li";
                        if (n.data(i)) return !1;
                        e.each(n.find("ul, li>div"), function() {
                            e(this).data(i, !0), e(this).hide()
                        }), e.each(n.find("em.open-close"), function() {
                            e(this).on("click", function() {
                                return void t(this, o)
                            }), e(this).on("activate-node", function() {
                                n.find(c).not(e(this).parents()).not(e(this).siblings()).slideUp(r), t(this, "slideDown")
                            })
                        });
                        var a = location.hash ? n.find("a[href=" + location.hash + "]")[0] : n.find("li.current a")[0];
                        a && t(a, !1)
                    })
                }
            }), e(function() {
                function t() {
                    var t = e('.navbar-collapse form[role="search"].active');
                    t.find("input").val(""), t.removeClass("active")
                }
                e('header, .navbar-collapse form[role="search"] button[type="reset"]').on("click keyup", function(n) {
                    console.log(n.currentTarget), (27 == n.which && e('.navbar-collapse form[role="search"]').hasClass("active") || "reset" == e(n.currentTarget).attr("type")) && t()
                }), e(document).on("click", '.navbar-collapse form[role="search"]:not(.active) button[type="submit"]', function(t) {
                    t.preventDefault();
                    var n = e(this).closest("form"),
                        i = n.find("input");
                    n.addClass("active"), i.focus()
                }), e(document).on("click", '.navbar-collapse form[role="search"].active button[type="submit"]', function(n) {
                    n.preventDefault();
                    var i = e(this).closest("form"),
                        s = i.find("input");
                    e("#showSearchTerm").text(s.val()), t()
                })
            })
          
    }(jQuery);    